<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public static function cardData(Project $p): array
    {
        return [
            'slug' => $p->slug,
            'title' => $p->title,
            'status' => $p->status,
            'status_label' => $p->status_label,
            'cover' => $p->cover_image ? Storage::url($p->cover_image) : null,
            'proposal_deadline' => $p->proposal_deadline?->format('Y-m-d'),
            'category' => $p->relationLoaded('category') && $p->category
                ? ['name' => $p->category->name, 'slug' => $p->category->slug]
                : null,
        ];
    }

    public function index(\Illuminate\Http\Request $request)
    {
        $active = $request->query('category');
        $status = $request->query('status');

        $categories = \App\Models\ProjectCategory::query()
            ->withCount(['projects' => fn ($q) => $q->published()])
            ->orderBy('sort')->get()
            ->filter(fn ($c) => $c->projects_count > 0)
            ->map(fn ($c) => ['name' => $c->name, 'slug' => $c->slug, 'count' => $c->projects_count])
            ->values();

        $projects = Project::query()
            ->published()->with('category')
            ->when($active, fn ($q) => $q->whereHas('category', fn ($c) => $c->where('slug', $active)))
            ->when($status, fn ($q) => $q->where('status', $status))
            ->orderByDesc('is_featured')->orderByDesc('published_at')
            ->paginate(12)->withQueryString()
            ->through(fn (Project $p) => self::cardData($p));

        return Inertia::render('Projects/Index', [
            'projects' => $projects,
            'categories' => $categories,
            'active' => $active,
            'activeStatus' => $status,
            'statusOptions' => Project::STATUSES,
        ]);
    }

    public function show(Project $project)
    {
        abort_if($project->published_at === null || $project->published_at->isFuture(), 404);

        $galleryFirst = ! empty($project->gallery) ? $project->gallery[0] : null;

        $related = Project::query()->published()->with('category')
            ->where('id', '!=', $project->id)
            ->where('project_category_id', $project->project_category_id)
            ->limit(3)->get()
            ->map(fn (Project $p) => self::cardData($p));

        return Inertia::render('Projects/Show', [
            'project' => [
                ...self::cardData($project),
                'summary' => $project->summary,
                'body' => $project->body,
                'proponent' => $project->proponent,
                'phase' => $project->phase,
                'study_status' => $project->study_status,
                'contract_type' => $project->contract_type,
                'contract_duration' => $project->contract_duration,
                'financing' => $project->financing,
                'policy_reference' => $project->policy_reference,
                'address' => $project->address,
                'preliminary_assessment_at' => $project->preliminary_assessment_at?->format('Y-m-d'),
                'info_meeting_at' => $project->info_meeting_at?->format('Y-m-d H:i'),
                'detail_image' => $galleryFirst
                    ? Storage::url($galleryFirst)
                    : ($project->cover_image ? Storage::url($project->cover_image) : null),
                'materials' => $project->materials->map(fn ($m) => [
                    'id' => $m->id,
                    'name' => $m->name,
                    'description' => $m->description,
                    'is_required' => $m->is_required,
                    'template_url' => $m->template_file ? Storage::url($m->template_file) : null,
                    'external_url' => $m->external_url,
                ]),
            ],
            'related' => $related,
        ]);
    }

    public function submitProposal(Request $request, Project $project)
    {
        abort_unless($project->status === 'open_for_proposals', 404);

        $materials = $project->materials;

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'organization' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'note' => ['nullable', 'string', 'max:2000'],
            'website' => ['nullable', 'string', 'max:255'], // honeypot
            'files' => ['nullable', 'array'],
            'files.*' => ['file', 'mimes:pdf,xlsx,xls,csv', 'max:10240'],
        ];

        foreach ($materials->where('is_required', true)->whereNull('external_url') as $material) {
            $rules["files.{$material->id}"] = ['required', 'file', 'mimes:pdf,xlsx,xls,csv', 'max:10240'];
        }

        $data = $request->validate($rules);

        if (! empty($data['website'])) {
            return back()->with('proposal_sent', true);
        }

        $proposal = $project->proposals()->create(
            collect($data)->only(['name', 'organization', 'phone', 'email', 'note'])->all()
        );

        $materialIds = $materials->pluck('id')->all();

        foreach ($request->file('files', []) as $materialId => $file) {
            $path = $file->store('proposals/' . $project->id, 'public');
            $proposal->files()->create([
                'project_material_id' => in_array((int) $materialId, $materialIds, true) ? (int) $materialId : null,
                'file_path' => $path,
                'original_name' => $file->getClientOriginalName(),
            ]);
        }

        return back()->with('proposal_sent', true);
    }
}
