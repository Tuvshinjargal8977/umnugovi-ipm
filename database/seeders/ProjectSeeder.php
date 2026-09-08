<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $cat = ProjectCategory::updateOrCreate(
            ['slug' => 'deed-baiguulamj'],
            ['name' => ['mn' => 'Дэд бүтэц', 'en' => 'Infrastructure'], 'sort' => 2],
        );

        Project::updateOrCreate(
            ['slug' => 'gurvansaikhan-nisekh-buudal'],
            [
                'project_category_id' => $cat->id,
                'title' => [
                    'mn' => 'Өмнөговь аймгийн “Гурвансайхан” нисэх буудлыг 4D ангилалын болгон хүчин чадлыг нэмэгдүүлж, ашиглалтыг сайжруулах төсөл',
                    'en' => 'Upgrading “Gurvansaikhan” Airport of Umnugovi Province to 4D category',
                ],
                'status' => 'open_for_proposals',
                'proponent' => ['mn' => 'Хувийн хэвшил', 'en' => 'Private sector'],
                'phase' => ['mn' => 'Урьдчилсан үнэлгээ', 'en' => 'Pre-assessment'],
                'study_status' => ['mn' => 'ТЭЗҮ боловсруулагдсан', 'en' => 'Feasibility study prepared'],
                'contract_type' => [
                    'mn' => 'Зураг төсөл, төсвийг боловсруулах-Барих-Ашиглах-Шилжүүлэх',
                    'en' => 'Design-Build-Operate-Transfer (DBOT)',
                ],
                'contract_duration' => ['mn' => '30 жилээс илүүгүй байна', 'en' => 'Not more than 30 years'],
                'address' => [
                    'mn' => 'Даланзадгад сум, Өмнөговь аймаг, Монгол Улс',
                    'en' => 'Dalanzadgad, Umnugovi Province, Mongolia',
                ],
                'preliminary_assessment_at' => '2025-07-09',
                'proposal_deadline' => '2026-04-13',
                'info_meeting_at' => '2026-03-26 14:00:00',
                'summary' => [
                    'mn' => 'Төр, хувийн хэвшлийн түншлэлийн тухай хуулийн 23.2-т заасны дагуу дараах төслийг түншлэлээр хэрэгжүүлэхээр урьдчилан зарлаж байна.',
                    'en' => 'Pursuant to Article 23.2 of the PPP Law, the following project is pre-announced for implementation through partnership.',
                ],
                'body' => [
                    'mn' => <<<'HTML'
<p>Төр, хувийн хэвшлийн түншлэлийн тухай хуулийн 23 дугаар зүйлийн 23.2-д „Түншлэлийн төслийг урьдчилан зарлах нь түншлэлээр хэрэгжүүлэх төслийг сонирхож байгаа олон нийтэд төслийн талаар мэдээлэл өгөх, хувийн хэвшлийн түншлэгчийн хөрөнгө оруулалтыг татах, тандан судлах зорилготой“ гэж заасны дагуу дараах төслийг түншлэлээр хэрэгжүүлэхээр зарлаж байна.</p>
<hr />
<p><strong>Түншлэлийн төслийн нэр:</strong> Өмнөговь аймгийн „Гурвансайхан“ нисэх буудлыг 4D ангилалын болгон хүчин чадлыг нэмэгдүүлж, ашиглалтыг сайжруулах төсөл</p>
<p><strong>Судлагдсан байдал:</strong> ТЭЗҮ боловсруулагдсан</p>
<p><strong>Урьдчилсан үнэлгээ:</strong> ТХХТХ-ийн дагуу 2025 оны 7 дугаар сарын 9-нд хийгдсэн</p>
<p style="text-align: justify;"><strong>Санал авах хугацаа:</strong> Тус төслийг хэрэгжүүлэх сонирхлоо илэрхийлсэн саналаа 2026 оны 04 дугаар сарын 13-ны өдрөөс өмнө Эдийн засаг, хөгжлийн яамны Төр, хувийн хэвшлийн түншлэлийн газарт эсвэл Төр, хувийн хэвшлийн түншлэлийн төвд ирүүлнэ үү.</p>
<p style="text-align: justify;"><strong>Мэдээлэл өгөх уулзалт:</strong> Түншлэлийн төслийн талаар сонирхож буй хувь хүн, аж ахуйн нэгжүүдэд мэдээлэл өгөх нэгдсэн уулзалтыг 2026 оны 03 дугаар сарын 26-ны өдрийн 14:00 цагт Төр, хувийн хэвшлийн түншлэлийн төвийн байранд зохион байгуулна. Лавлах утас: 7588-3377.</p>
HTML,
                    'en' => '<p>Pursuant to Article 23.2 of the Law on Public–Private Partnership, the following project is pre-announced for implementation through partnership. Expressions of interest should be submitted before 13 April 2026.</p>',
                ],
                'policy_reference' => [
                    'mn' => <<<'HTML'
<p style="text-align: justify;">Монгол Улсын Их Хурлын 2020 оны 52 дугаар тогтоолоор баталсан „Алсын хараа-2050“ Монгол Улсын урт хугацааны хөгжлийн бодлогын 8.1 дүгээр зорилтын 6. „Зарим аймгуудын нисэх буудлыг 4C, 4D зэрэглэл бүхий агаарын хөлөг хүлээн авах хүчин чадалтай болгож, аялал жуулчлал, гадаад худалдааг дэмжинэ“.</p>
<p style="text-align: justify;">Монгол Улсын Засгийн Газрын 2024–2028 оны үйл ажиллагааны хөтөлбөрийн 3.3.2.11. Орон нутгийн нисэх буудлуудыг 4С, 4D ангиллын шаардлагад нийцүүлэн өргөтгөх, хүчин чадлыг нэмэгдүүлэх ажлыг төр, хувийн хэвшлийн түншлэлээр хэрэгжүүлнэ.</p>
HTML,
                    'en' => '<p>Aligned with Vision 2050 (Parliament Resolution 52 of 2020) and the Government Action Plan 2024–2028, section 3.3.2.11.</p>',
                ],
                'financing' => [
                    'mn' => <<<'HTML'
<p>Төр, хувийн хэвшлийн түншлэлийн тухай хуулийн 14 дүгээр зүйлд заасны дагуу дараах хувилбарын аль нэгээр хэрэгжүүлнэ:</p>
<ul>
<li>төслийн зардлыг хэрэглэгчийн төлбөр, хураамж болон төслийн орлогоор санхүүжүүлэх;</li>
<li>төсвөөс санхүүжүүлэх;</li>
<li>холимог төрөл.</li>
</ul>
HTML,
                    'en' => '<p>User charges, state budget, or a mixed model, per Article 14 of the PPP Law.</p>',
                ],
                'cover_image' => null,
                'is_featured' => true,
                'published_at' => now(),
            ],
        );
    }
}
