<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

/**
 * Өмнөговь аймагт төр, хувийн хэвшлийн түншлэлээр хэрэгжүүлэхээр
 * батлагдсан төслүүдийн жагсаалт (танилцуулгын мэдээллээс).
 */
class UmnugoviProjectSeeder extends Seeder
{
    public function run(): void
    {
        $cats = [];
        foreach ([
            ['Эрчим хүч', 'erchim-khuch', 1],
            ['Дэд бүтэц', 'deed-baiguulamj', 2],
            ['Худалдаа, үйлчилгээ', 'khudaldaa-uilchilgee', 3],
            ['Барилга, орон сууц', 'barilga-oron-suuts', 4],
            ['Аж үйлдвэр', 'azh-uildver', 5],
            ['Хөдөө аж ахуй', 'khodoo-azh-akhui', 6],
            ['Нийтийн үйлчилгээ', 'niitiin-uilchilgee', 7],
            ['Аялал жуулчлал', 'ayalal-julchlal', 8],
        ] as [$name, $slug, $sort]) {
            $cats[$slug] = ProjectCategory::updateOrCreate(
                ['slug' => $slug],
                ['name' => ['mn' => $name, 'en' => $name], 'sort' => $sort],
            );
        }

        $base = [
            'proponent' => ['mn' => 'Өмнөговь аймгийн Засаг даргын Тамгын газар'],
            'contract_type' => ['mn' => 'Барих-Ашиглах-Шилжүүлэх (BOT) / холимог'],
            'contract_duration' => ['mn' => 'Төслийн онцлогоос хамаарна'],
            'address' => ['mn' => 'Даланзадгад сум, Өмнөговь аймаг, Монгол Улс'],
        ];

        $projects = [
            [
                'slug' => 'khudaldaany-tuv-zakh',
                'title' => '“Худалдааны төв зах” байгуулах төсөл',
                'cat' => 'khudaldaa-uilchilgee', 'status' => 'pre_assessment', 'featured' => true,
                'summary' => 'Даланзадгад хотод орчин үеийн худалдаа, үйлчилгээний цогцолбор “Худалдааны төв зах” байгуулах төсөл. Урьдчилсан хөрөнгө оруулалт 40–50 тэрбум төгрөг.',
                'body' => '<p>Даланзадгад хотод бөөний болон жижиглэн худалдаа, үйлчилгээг нэг цэгт төвлөрүүлсэн орчин үеийн “Худалдааны төв зах” цогцолборыг төр, хувийн хэвшлийн түншлэлээр байгуулна. Газрын төслийг сонгон шалгаруулалтаар олгоно.</p><ul><li>Урьдчилсан хөрөнгө оруулалтын хэмжээ: <strong>40–50 тэрбум төгрөг</strong>;</li><li>Нэг байршил, нэгдсэн төлөвлөлт, дэд бүтэц, аюулгүй орчин, олон төрлийн худалдаа, үйлчилгээ.</li></ul>',
                'financing' => '<p>Төслийн зардлыг хэрэглэгчийн төлбөр, түрээсийн орлого болон холимог хэлбэрээр санхүүжүүлэхээр судалж байна.</p>',
            ],
            [
                'slug' => 'shar-teeg-teeverchdiin-tuv',
                'title' => 'Ханхонгор сумын “Шар тээгийн уулзвар”-т тээвэрчдийн үйлчилгээний төв байгуулах төсөл',
                'cat' => 'deed-baiguulamj', 'status' => 'pre_assessment', 'featured' => true,
                'summary' => 'Ханхонгор сумын “Шар тээгийн уулзвар” дээр тээвэрчдийн иж бүрэн үйлчилгээний төв байгуулах төсөл. Урьдчилсан хөрөнгө оруулалт 10–15 тэрбум төгрөг.',
                'body' => '<p>Улсын чанартай авто замын “Шар тээгийн уулзвар” дээр ачаа тээвэрлэгч, жолооч нарт зориулсан амралт, хоол, түлш, засвар үйлчилгээ, ачаа хадгалалтын иж бүрэн төвийг байгуулна.</p><ul><li>Урьдчилсан хөрөнгө оруулалтын хэмжээ: <strong>10–15 тэрбум төгрөг</strong>.</li></ul>',
                'financing' => '<p>Хэрэглэгчийн төлбөр, үйлчилгээний орлогоор санхүүжүүлэх хувилбарыг судалж байна.</p>',
            ],
            [
                'slug' => 'ondognii-azh-akhui',
                'title' => 'Өндөгний аж ахуй байгуулах төсөл',
                'cat' => 'khodoo-azh-akhui', 'status' => 'pre_assessment',
                'summary' => 'Өмнөговь аймгийн хүн амыг өндөг, шувууны махаар хангах үйлдвэрлэлийн аж ахуй байгуулах төсөл. Урьдчилсан хөрөнгө оруулалт 2,16 тэрбум төгрөг.',
                'body' => '<p>Аймгийн хүн амыг чанартай өндөг, шувууны махаар тогтвортой хангах, орон нутгийн хүнсний хангамжийг сайжруулах зорилготой үйлдвэрлэлийн өндөгний аж ахуйг төр, хувийн хэвшлийн түншлэлээр байгуулна.</p><ul><li>Урьдчилсан хөрөнгө оруулалтын хэмжээ: <strong>2,16 тэрбум төгрөг</strong>.</li></ul>',
            ],
            [
                'slug' => 'orshuulgyn-uil-ajillagaa',
                'title' => 'Оршуулгын үйл ажиллагаа эрхлэх, зохион байгуулах төсөл',
                'cat' => 'niitiin-uilchilgee', 'status' => 'pre_assessment',
                'summary' => 'Даланзадгад суманд оршуулгын үйлчилгээ, дурсгал хүндэтгэлийн цогцолбор, ногоон байгууламж бүхий 10 га талбай бүхий цогцолбор байгуулах төсөл. Урьдчилсан хөрөнгө оруулалт 15 тэрбум төгрөг.',
                'body' => '<p>Даланзадгад суманд оршуулгын үйлчилгээг стандартын дагуу зохион байгуулах, дурсгал хүндэтгэлийн цогцолбор, ногоон байгууламж, зам талбай бүхий иж бүрэн цогцолбор байгуулна.</p><p><strong>Техник эдийн засгийн үндсэн үзүүлэлт:</strong></p><ul><li>Нийт талбай: 10 га;</li><li>Ногоон байгууламж: 60%-иас доошгүй;</li><li>Авто зогсоол: 50 машины багтаамжтай;</li><li>Дотоод авто замын урт: ойролцоогоор 850 м;</li><li>Урьдчилсан хөрөнгө оруулалтын хэмжээ: <strong>15 тэрбум төгрөг</strong>.</li></ul>',
            ],

            ['slug' => 'nar-salkhi-100mvt', 'title' => 'Нар, салхины эрчим хүчээр 100 МВт хүртэл хүчин чадалтай цахилгаан станц барьж байгуулах', 'cat' => 'erchim-khuch', 'status' => 'under_study'],
            ['slug' => 'shokhoin-chuluu-uildver', 'title' => 'Шохойн чулууны үйлдвэр байгуулах', 'cat' => 'azh-uildver', 'status' => 'under_study'],
            ['slug' => 'khog-bolovsruulakh-uildver', 'title' => 'Хог хаягдлын менежментийг сайжруулж, хог боловсруулах үйлдвэрүүд байгуулах', 'cat' => 'niitiin-uilchilgee', 'status' => 'under_study'],
            ['slug' => 'ars-shir-bolovsruulakh', 'title' => 'Арьс шир боловсруулах үйлдвэр байгуулах', 'cat' => 'azh-uildver', 'status' => 'under_study'],
            ['slug' => 'avtozamyn-zasvar-archlalt', 'title' => 'Автозамын ашиглалт, засвар арчлалтыг хэрэгжүүлэх', 'cat' => 'deed-baiguulamj', 'status' => 'under_study'],
            ['slug' => 'teever-logistikiin-tuv', 'title' => 'Ханбогд, Цогт-Овоо, Гурвантэс сумдад тээвэр, логистикийн төв байгуулах', 'cat' => 'deed-baiguulamj', 'status' => 'under_study'],
            ['slug' => 'tavantolgoi-dalanzadgad-tumor-zam', 'title' => 'Тавантолгой ордоос Даланзадгад сум хүртэлх төмөр зам барих', 'cat' => 'deed-baiguulamj', 'status' => 'under_study'],
            ['slug' => 'dalanzadgad-gurvantes-zam', 'title' => 'Даланзадгад–Гурвантэс чиглэлийн автозамын засвар, арчлалтыг хариуцах компанийг сонгон шалгаруулах', 'cat' => 'deed-baiguulamj', 'status' => 'under_study'],
            ['slug' => 'tsengeldekh-khureelen-10000', 'title' => '10 000 хүний суудалтай цэнгэлдэх хүрээлэн байгуулах', 'cat' => 'barilga-oron-suuts', 'status' => 'under_study'],
            ['slug' => 'naishil-arena', 'title' => 'Чандмань /Найшил/ арена барилга байгуулах', 'cat' => 'barilga-oron-suuts', 'status' => 'under_study'],
            ['slug' => 'usan-sport-tsogtsolbor', 'title' => 'Усан спорт цогцолборын барилга байгуулах', 'cat' => 'barilga-oron-suuts', 'status' => 'under_study'],
            ['slug' => 'usan-park', 'title' => 'Усан парк байгуулах', 'cat' => 'barilga-oron-suuts', 'status' => 'under_study'],
            ['slug' => 'oron-suutsny-khotkhon-2000', 'title' => 'Даланзадгад, Ханбогд, Цогтцэций, Гурвантэс сумдад 2000-с дээш айлын орон сууцны хотхон барьж байгуулах', 'cat' => 'barilga-oron-suuts', 'status' => 'under_study'],
            ['slug' => 'niitiin-ded-butets', 'title' => 'Хувийн хэвшлийн хөрөнгө оруулалтаар нийтийн дэд бүтцийн бүтээн байгуулалт хийх', 'cat' => 'deed-baiguulamj', 'status' => 'under_study'],
            ['slug' => 'ayalal-julchlalyn-ded-butets', 'title' => 'Бүс нутгийн аялал жуулчлал, замын дагуух дэд бүтцийн бүтээн байгуулалт', 'cat' => 'ayalal-julchlal', 'status' => 'under_study'],
        ];

        foreach ($projects as $i => $p) {
            Project::updateOrCreate(
                ['slug' => $p['slug']],
                [
                    ...$base,
                    'project_category_id' => $cats[$p['cat']]->id,
                    'title' => ['mn' => $p['title'], 'en' => $p['title']],
                    'status' => $p['status'],
                    'phase' => ['mn' => $p['status'] === 'pre_assessment' ? 'Урьдчилсан үнэлгээ' : 'Тандан судалгаа'],
                    'study_status' => ['mn' => $p['status'] === 'pre_assessment' ? 'Урьдчилсан үнэлгээ хийгдсэн' : 'Судалгааны шатанд'],
                    'summary' => ['mn' => $p['summary'] ?? ($p['title'] . '-ыг Өмнөговь аймагт төр, хувийн хэвшлийн түншлэлээр хэрэгжүүлэхээр батлагдсан.')],
                    'body' => ['mn' => $p['body'] ?? ('<p>' . $p['title'] . '-ыг Өмнөговь аймгийн Засаг даргын Тамгын газраас төр, хувийн хэвшлийн түншлэлээр хэрэгжүүлэхээр төлөвлөж, судалгааны ажлыг эхлүүлээд байна.</p>')],
                    'financing' => isset($p['financing']) ? ['mn' => $p['financing']] : null,
                    'policy_reference' => ['mn' => '<p>Өмнөговь аймагт төр, хувийн хэвшлийн түншлэлээр хэрэгжүүлэхээр батлагдсан төслүүдийн жагсаалтад тусгагдсан.</p>'],
                    'is_featured' => $p['featured'] ?? false,
                    'published_at' => Carbon::now()->subDays($i + 2),
                ],
            );
        }
    }
}
