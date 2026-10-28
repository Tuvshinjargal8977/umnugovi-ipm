import { useForm, usePage } from '@inertiajs/react';
import { useEffect, useRef } from 'react';
import type { FormEvent } from 'react';
import type { Project, ProjectCard as ProjectT, SharedProps } from '@/types';
import Container from '@/Components/Container';
import Seo from '@/Components/Seo';
import PageHero from '@/Components/PageHero';
import SectionHeading from '@/Components/SectionHeading';
import ProjectCard from '@/Components/ProjectCard';
import { Button } from '@/Components/Button';

const FALLBACK = '/images/placeholder.svg';

const field = 'w-full rounded-md border border-line px-3 py-2 text-[0.8rem] outline-none focus:border-brand-400';
const label = 'mb-1 block text-[0.72rem] font-semibold text-ink';

function StepBadge({ n }: { n: number }) {
    return (
        <span className="inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-brand-600 text-[0.72rem] font-bold text-white">
            {n}
        </span>
    );
}

function FilePicker({
    id,
    file,
    onChange,
    hasError,
}: {
    id: string;
    file: File | null;
    onChange: (f: File | null) => void;
    hasError?: boolean;
}) {
    return (
        <div
            className={`flex flex-wrap items-center gap-2.5 rounded-md border px-2.5 py-2 transition-colors ${
                hasError
                    ? 'border-red-400 bg-red-50/40 dark:border-red-700 dark:bg-red-950/20'
                    : file
                      ? 'border-green-400 bg-green-50/40 dark:border-green-700 dark:bg-green-950/20'
                      : 'border-line'
            }`}
        >
            <label
                htmlFor={id}
                className="inline-flex shrink-0 cursor-pointer items-center gap-1.5 rounded-md bg-brand-700 px-3 py-1.5 text-[0.68rem] font-bold uppercase tracking-wide text-white transition-colors hover:bg-brand-800"
            >
                <i className="bi bi-paperclip" /> Файл сонгох
            </label>
            <input
                id={id}
                type="file"
                accept=".pdf,.xlsx,.xls,.csv,application/pdf,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,text/csv"
                className="hidden"
                onChange={(e) => onChange(e.target.files?.[0] ?? null)}
            />
            {file ? (
                <span className="inline-flex min-w-0 items-center gap-1 text-[0.76rem] font-medium text-green-700 dark:text-green-400">
                    <i className="bi bi-check-circle-fill shrink-0" />
                    <span className="truncate">{file.name}</span>
                    <button
                        type="button"
                        onClick={() => onChange(null)}
                        className="ml-1 shrink-0 text-ink-soft hover:text-red-600 dark:hover:text-red-400"
                        aria-label="Файл хасах"
                    >
                        <i className="bi bi-x-circle" />
                    </button>
                </span>
            ) : (
                <span className="text-[0.74rem] text-ink-soft">Файл сонгогдоогүй байна</span>
            )}
        </div>
    );
}

function ProposalForm({ project }: { project: Project }) {
    const { flash } = usePage<SharedProps>().props;
    const formRef = useRef<HTMLDivElement>(null);
    const { data, setData, post, processing, errors, reset, recentlySuccessful } = useForm<{
        name: string;
        phone: string;
        email: string;
        website: string;
        files: Record<number, File | null>;
    }>({
        name: '',
        phone: '',
        email: '',
        website: '',
        files: {},
    });

    const hasErrors = Object.keys(errors).length > 0;

    useEffect(() => {
        if (recentlySuccessful || hasErrors) {
            formRef.current?.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [recentlySuccessful, hasErrors]);

    const submit = (e: FormEvent) => {
        e.preventDefault();
        post(`/projects/${project.slug}/proposal`, {
            forceFormData: true,
            preserveScroll: true,
            onSuccess: () => reset(),
        });
    };

    const setFile = (materialId: number, file: File | null) => {
        setData('files', { ...data.files, [materialId]: file });
    };

    return (
        <section id="proposal" className="border-t border-line bg-surface-sunken">
            <Container className="py-12">
                <div ref={formRef} className="scroll-mt-24">
                    <SectionHeading>Санал ирүүлэх</SectionHeading>
                    <p className="-mt-4 mb-6 text-[0.82rem] text-ink-soft">
                        Доорх мэдээллээ бөглөж, шаардлагатай материалаа PDF эсвэл Excel (xlsx) хэлбэрээр хавсаргаад илгээнэ үү.
                        <span className="text-red-500"> * </span>тэмдэгтэй талбарыг заавал бөглөнө.
                    </p>

                    {recentlySuccessful && flash.proposalSent && (
                        <div className="mb-6 flex items-start gap-3 rounded-card border border-green-200 bg-green-50 px-5 py-4 text-[0.85rem] text-green-800 dark:border-green-800 dark:bg-green-950/30 dark:text-green-300">
                            <i className="bi bi-check-circle-fill mt-0.5 text-lg" />
                            <div>
                                <p className="font-bold">Амжилттай илгээгдлээ!</p>
                                <p>{flash.proposalSent}</p>
                            </div>
                        </div>
                    )}
                    {hasErrors && (
                        <div className="mb-6 flex items-start gap-3 rounded-card border border-red-200 bg-red-50 px-5 py-4 text-[0.85rem] text-red-700 dark:border-red-800 dark:bg-red-950/30 dark:text-red-300">
                            <i className="bi bi-exclamation-triangle-fill mt-0.5 text-lg" />
                            <p>Зарим талбар дутуу эсвэл буруу байна. Доорх улаанаар тэмдэглэсэн зүйлсийг шалгаад дахин оролдоно уу.</p>
                        </div>
                    )}

                    <form onSubmit={submit} className="flex flex-col gap-8 rounded-card border border-line bg-surface p-6">
                        <input
                            type="text"
                            name="website"
                            tabIndex={-1}
                            autoComplete="off"
                            aria-hidden="true"
                            className="hidden"
                            value={data.website}
                            onChange={(e) => setData('website', e.target.value)}
                        />

                        {/* step 1 — applicant info */}
                        <div>
                            <div className="mb-4 flex items-center gap-2.5">
                                <StepBadge n={1} />
                                <h3 className="text-[0.95rem] font-bold text-ink">Таны мэдээлэл</h3>
                            </div>
                            <div className="grid gap-4 sm:grid-cols-2">
                                <div className="sm:col-span-2">
                                    <label className={label} htmlFor="p-name">
                                        Нэр / Байгууллагын төлөөлөл <span className="text-red-500">*</span>
                                    </label>
                                    <input
                                        id="p-name"
                                        className={field}
                                        placeholder="Жишээ: Б.Бат"
                                        value={data.name}
                                        onChange={(e) => setData('name', e.target.value)}
                                        required
                                    />
                                    {errors.name && (
                                        <p className="mt-1 text-[0.72rem] text-red-600 dark:text-red-400">{errors.name}</p>
                                    )}
                                </div>
                                <div>
                                    <label className={label} htmlFor="p-phone">
                                        Утас
                                    </label>
                                    <input
                                        id="p-phone"
                                        className={field}
                                        placeholder="9911-9911"
                                        value={data.phone}
                                        onChange={(e) => setData('phone', e.target.value)}
                                    />
                                </div>
                                <div>
                                    <label className={label} htmlFor="p-email">
                                        Имэйл
                                    </label>
                                    <input
                                        id="p-email"
                                        type="email"
                                        className={field}
                                        placeholder="jishee@email.mn"
                                        value={data.email}
                                        onChange={(e) => setData('email', e.target.value)}
                                    />
                                </div>
                            </div>
                        </div>

                        {/* step 2 — materials */}
                        {project.materials.length > 0 && (
                            <div className="border-t border-line pt-6">
                                <div className="mb-4 flex items-center gap-2.5">
                                    <StepBadge n={2} />
                                    <h3 className="text-[0.95rem] font-bold text-ink">Материал хавсаргах</h3>
                                    <span className="text-[0.72rem] text-ink-soft">(PDF эсвэл Excel, тус бүр 10MB хүртэл)</span>
                                </div>
                                <div className="flex flex-col gap-3">
                                    {project.materials.map((m, i) => (
                                        <div
                                            key={m.id}
                                            className="rounded-lg border border-line bg-surface-sunken/60 p-4 shadow-sm"
                                        >
                                            <div className="mb-2.5">
                                                <p className="flex items-start gap-2 text-[0.84rem] font-bold text-ink">
                                                    <span className="mt-0.5 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-ink/10 text-[0.68rem] font-bold text-ink">
                                                        {i + 1}
                                                    </span>
                                                    <span>
                                                        {m.name}
                                                        {m.is_required && <span className="ml-1 text-red-500">*</span>}
                                                        {m.description && (
                                                            <span className="mt-0.5 block text-[0.76rem] font-normal text-ink-soft">
                                                                {m.description}
                                                            </span>
                                                        )}
                                                    </span>
                                                </p>
                                            </div>
                                            {m.template_url && (
                                                <div className="mb-3 flex flex-wrap items-center gap-2.5 rounded-md border border-dashed border-brand-300 bg-surface px-3 py-2.5 dark:border-brand-700">
                                                    <span className="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-brand-600 text-[0.62rem] font-bold text-white">
                                                        1
                                                    </span>
                                                    <span className="flex-1 text-[0.76rem] text-ink-soft">
                                                        Эхлээд загвар файлаа татаж аваад бөглөнө үү
                                                    </span>
                                                    <a
                                                        href={m.template_url}
                                                        className="inline-flex shrink-0 items-center gap-1.5 rounded-md border border-brand-600 px-3 py-1.5 text-[0.68rem] font-bold uppercase tracking-wide text-brand-600 transition-colors hover:bg-brand-600 hover:text-white dark:text-brand-300"
                                                    >
                                                        <i className="bi bi-download" /> Загвар татах
                                                    </a>
                                                </div>
                                            )}
                                            {m.template_url && !m.external_url && (
                                                <div className="mb-2 flex items-center gap-2.5">
                                                    <span className="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-brand-600 text-[0.62rem] font-bold text-white">
                                                        2
                                                    </span>
                                                    <span className="text-[0.76rem] text-ink-soft">
                                                        Бөглөсөн файлаа буцааж энд хавсаргана уу
                                                    </span>
                                                </div>
                                            )}
                                            {m.external_url ? (
                                                <div className="flex flex-wrap items-center gap-2.5 rounded-md border border-brand-200 bg-brand-tint px-2.5 py-2 dark:border-brand-800">
                                                    <a
                                                        href={m.external_url}
                                                        target="_blank"
                                                        rel="noopener"
                                                        className="inline-flex shrink-0 items-center gap-1.5 rounded-md bg-brand-700 px-3 py-1.5 text-[0.68rem] font-bold uppercase tracking-wide text-white transition-colors hover:bg-brand-800"
                                                    >
                                                        <i className="bi bi-box-arrow-up-right" /> Форм бөглөх
                                                    </a>
                                                    <span className="text-[0.74rem] text-ink-soft">
                                                        Онлайн маягтаар бөглөнө — файл хавсаргах шаардлагагүй
                                                    </span>
                                                </div>
                                            ) : (
                                                <>
                                                    <FilePicker
                                                        id={`p-file-${m.id}`}
                                                        file={data.files[m.id] ?? null}
                                                        onChange={(f) => setFile(m.id, f)}
                                                        hasError={!!errors[`files.${m.id}`]}
                                                    />
                                                    {errors[`files.${m.id}`] && (
                                                        <p className="mt-1.5 text-[0.72rem] text-red-600 dark:text-red-400">
                                                            {errors[`files.${m.id}`]}
                                                        </p>
                                                    )}
                                                </>
                                            )}
                                        </div>
                                    ))}
                                </div>
                            </div>
                        )}

                        <div>
                            <Button type="submit" disabled={processing} className="w-full justify-center sm:w-auto">
                                {processing ? (
                                    <>Илгээж байна…</>
                                ) : (
                                    <>
                                        Санал илгээх <i className="bi bi-send-fill" />
                                    </>
                                )}
                            </Button>
                        </div>
                    </form>
                </div>
            </Container>
        </section>
    );
}

export default function Show({ project, related }: { project: Project; related: ProjectT[] }) {
    return (
        <>
            <Seo
                title={project.title}
                description={project.summary || undefined}
                image={project.cover}
                type="article"
            />
            <PageHero
                title={project.title}
                image={project.cover}
                crumbs={[
                    { label: 'Нүүр', href: '/' },
                    { label: 'Төслүүд', href: '/projects' },
                    { label: project.title.length > 40 ? project.title.slice(0, 40) + '…' : project.title },
                ]}
            />

            {/* detail */}
            {(project.body || project.policy_reference || project.financing) && (
                <section id="detail" className="border-t border-line bg-surface">
                    <Container className="flex flex-col gap-4 py-12">
                        <SectionHeading>Төслийн дэлгэрэнгүй мэдээлэл</SectionHeading>
                        {project.summary && <p className="text-[0.9rem] leading-relaxed text-ink">{project.summary}</p>}
                        <hr className="my-1 border-line" />
                        <div className="grid items-start gap-8 md:grid-cols-2">
                            <div className="overflow-hidden rounded-lg border border-line md:sticky md:top-[7.5rem]">
                                <img
                                    src={project.detail_image || FALLBACK}
                                    alt={project.detail_image ? project.title : ''}
                                    loading="lazy"
                                    className="w-full"
                                />
                            </div>
                            <div className="prose-cms">
                                {project.body && <div dangerouslySetInnerHTML={{ __html: project.body }} />}
                                {project.policy_reference && (
                                    <>
                                        <p>
                                            <strong>Хөгжлийн бодлогын баримт бичигт тусгагдсан эсэх:</strong>
                                        </p>
                                        <div dangerouslySetInnerHTML={{ __html: project.policy_reference }} />
                                    </>
                                )}
                                {project.financing && (
                                    <>
                                        <p>
                                            <strong>Санхүүжилтийн хэлбэр:</strong>
                                        </p>
                                        <div dangerouslySetInnerHTML={{ __html: project.financing }} />
                                    </>
                                )}
                                {project.address && (
                                    <p className="text-justify">
                                        <strong>Хаяг:</strong> {project.address}
                                    </p>
                                )}
                            </div>
                        </div>
                    </Container>
                </section>
            )}

            {/* proposal submission */}
            {project.status === 'open_for_proposals' && <ProposalForm project={project} />}

            {/* related */}
            {related.length > 0 && (
                <section className="border-t border-line bg-surface-sunken">
                    <Container className="py-12">
                        <SectionHeading size="sm">Холбоотой төслүүд</SectionHeading>
                        <div className="grid gap-5 md:grid-cols-3">
                            {related.map((p) => (
                                <ProjectCard key={p.slug} project={p} />
                            ))}
                        </div>
                    </Container>
                </section>
            )}
        </>
    );
}
