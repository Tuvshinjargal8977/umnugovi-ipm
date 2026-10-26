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
            ['Эрчим хүч', 'Energy', 'erchim-khuch', 1],
            ['Дэд бүтэц', 'Infrastructure', 'deed-baiguulamj', 2],
            ['Худалдаа, үйлчилгээ', 'Trade & services', 'khudaldaa-uilchilgee', 3],
            ['Барилга, орон сууц', 'Construction & housing', 'barilga-oron-suuts', 4],
            ['Аж үйлдвэр', 'Manufacturing', 'azh-uildver', 5],
            ['Хөдөө аж ахуй', 'Agriculture', 'khodoo-azh-akhui', 6],
            ['Нийтийн үйлчилгээ', 'Public services', 'niitiin-uilchilgee', 7],
            ['Аялал жуулчлал', 'Tourism', 'ayalal-julchlal', 8],
        ] as [$nameMn, $nameEn, $slug, $sort]) {
            $cats[$slug] = ProjectCategory::updateOrCreate(
                ['slug' => $slug],
                ['name' => ['mn' => $nameMn, 'en' => $nameEn], 'sort' => $sort],
            );
        }

        $base = [
            'proponent' => [
                'mn' => 'Өмнөговь аймгийн Засаг даргын Тамгын газар',
                'en' => 'Office of the Governor of Umnugovi Province',
            ],
            'contract_type' => [
                'mn' => 'Барих-Ашиглах-Шилжүүлэх (BOT) / холимог',
                'en' => 'Build-Operate-Transfer (BOT) / mixed',
            ],
            'contract_duration' => [
                'mn' => 'Төслийн онцлогоос хамаарна',
                'en' => 'Depends on project specifics',
            ],
            'address' => [
                'mn' => 'Даланзадгад сум, Өмнөговь аймаг, Монгол Улс',
                'en' => 'Dalanzadgad, Umnugovi Province, Mongolia',
            ],
        ];

        $projects = [
            [
                'slug' => 'khudaldaany-tuv-zakh',
                'title' => ['mn' => '“Худалдааны төв зах” байгуулах төсөл', 'en' => '"Trade Center Market" Development Project'],
                'cat' => 'khudaldaa-uilchilgee', 'status' => 'pre_assessment', 'featured' => true,
                'summary' => [
                    'mn' => 'Даланзадгад хотод орчин үеийн худалдаа, үйлчилгээний цогцолбор “Худалдааны төв зах” байгуулах төсөл. Урьдчилсан хөрөнгө оруулалт 40–50 тэрбум төгрөг.',
                    'en' => 'Project to build a modern trade and services complex, the "Trade Center Market", in Dalanzadgad. Preliminary investment: MNT 40–50 billion.',
                ],
                'body' => [
                    'mn' => '<p>Даланзадгад хотод бөөний болон жижиглэн худалдаа, үйлчилгээг нэг цэгт төвлөрүүлсэн орчин үеийн “Худалдааны төв зах” цогцолборыг төр, хувийн хэвшлийн түншлэлээр байгуулна. Газрын төслийг сонгон шалгаруулалтаар олгоно.</p><ul><li>Урьдчилсан хөрөнгө оруулалтын хэмжээ: <strong>40–50 тэрбум төгрөг</strong>;</li><li>Нэг байршил, нэгдсэн төлөвлөлт, дэд бүтэц, аюулгүй орчин, олон төрлийн худалдаа, үйлчилгээ.</li></ul>',
                    'en' => '<p>A modern "Trade Center Market" complex consolidating wholesale and retail trade and services in one location will be built in Dalanzadgad through public–private partnership. The land plot will be awarded through a competitive tender.</p><ul><li>Preliminary investment: <strong>MNT 40–50 billion</strong>;</li><li>One location, integrated planning, infrastructure, a safe environment, and diverse trade and services.</li></ul>',
                ],
                'financing' => [
                    'mn' => '<p>Төслийн зардлыг хэрэглэгчийн төлбөр, түрээсийн орлого болон холимог хэлбэрээр санхүүжүүлэхээр судалж байна.</p>',
                    'en' => '<p>Financing options under consideration include user charges, lease income, and a mixed model.</p>',
                ],
            ],
            [
                'slug' => 'shar-teeg-teeverchdiin-tuv',
                'title' => [
                    'mn' => 'Ханхонгор сумын “Шар тээгийн уулзвар”-т тээвэрчдийн үйлчилгээний төв байгуулах төсөл',
                    'en' => 'Trucker Services Center at "Shar Teeg Junction", Khankhongor Soum',
                ],
                'cat' => 'deed-baiguulamj', 'status' => 'pre_assessment', 'featured' => true,
                'summary' => [
                    'mn' => 'Ханхонгор сумын “Шар тээгийн уулзвар” дээр тээвэрчдийн иж бүрэн үйлчилгээний төв байгуулах төсөл. Урьдчилсан хөрөнгө оруулалт 10–15 тэрбум төгрөг.',
                    'en' => 'Project to build a comprehensive trucker services center at "Shar Teeg Junction" in Khankhongor soum. Preliminary investment: MNT 10–15 billion.',
                ],
                'body' => [
                    'mn' => '<p>Улсын чанартай авто замын “Шар тээгийн уулзвар” дээр ачаа тээвэрлэгч, жолооч нарт зориулсан амралт, хоол, түлш, засвар үйлчилгээ, ачаа хадгалалтын иж бүрэн төвийг байгуулна.</p><ul><li>Урьдчилсан хөрөнгө оруулалтын хэмжээ: <strong>10–15 тэрбум төгрөг</strong>.</li></ul>',
                    'en' => '<p>A comprehensive service center for freight carriers and drivers — offering rest areas, catering, fuel, vehicle repair and cargo storage — will be built at "Shar Teeg Junction" on a national highway.</p><ul><li>Preliminary investment: <strong>MNT 10–15 billion</strong>.</li></ul>',
                ],
                'financing' => [
                    'mn' => '<p>Хэрэглэгчийн төлбөр, үйлчилгээний орлогоор санхүүжүүлэх хувилбарыг судалж байна.</p>',
                    'en' => '<p>A financing model based on user charges and service revenue is under consideration.</p>',
                ],
            ],
            [
                'slug' => 'ondognii-azh-akhui',
                'title' => ['mn' => 'Өндөгний аж ахуй байгуулах төсөл', 'en' => 'Egg Farm Development Project'],
                'cat' => 'khodoo-azh-akhui', 'status' => 'pre_assessment',
                'summary' => [
                    'mn' => 'Өмнөговь аймгийн хүн амыг өндөг, шувууны махаар хангах үйлдвэрлэлийн аж ахуй байгуулах төсөл. Урьдчилсан хөрөнгө оруулалт 2,16 тэрбум төгрөг.',
                    'en' => 'Project to establish a poultry farm supplying Umnugovi Province with eggs and poultry meat. Preliminary investment: MNT 2.16 billion.',
                ],
                'body' => [
                    'mn' => '<p>Аймгийн хүн амыг чанартай өндөг, шувууны махаар тогтвортой хангах, орон нутгийн хүнсний хангамжийг сайжруулах зорилготой үйлдвэрлэлийн өндөгний аж ахуйг төр, хувийн хэвшлийн түншлэлээр байгуулна.</p><ul><li>Урьдчилсан хөрөнгө оруулалтын хэмжээ: <strong>2,16 тэрбум төгрөг</strong>.</li></ul>',
                    'en' => '<p>A commercial egg farm will be established through public–private partnership to provide a stable supply of quality eggs and poultry meat and to improve local food security.</p><ul><li>Preliminary investment: <strong>MNT 2.16 billion</strong>.</li></ul>',
                ],
            ],
            [
                'slug' => 'orshuulgyn-uil-ajillagaa',
                'title' => [
                    'mn' => 'Оршуулгын үйл ажиллагаа эрхлэх, зохион байгуулах төсөл',
                    'en' => 'Funeral Services Organization Project',
                ],
                'cat' => 'niitiin-uilchilgee', 'status' => 'pre_assessment',
                'summary' => [
                    'mn' => 'Даланзадгад суманд оршуулгын үйлчилгээ, дурсгал хүндэтгэлийн цогцолбор, ногоон байгууламж бүхий 10 га талбай бүхий цогцолбор байгуулах төсөл. Урьдчилсан хөрөнгө оруулалт 15 тэрбум төгрөг.',
                    'en' => 'Project to build a 10-hectare complex in Dalanzadgad soum comprising funeral services, a memorial complex, and green space. Preliminary investment: MNT 15 billion.',
                ],
                'body' => [
                    'mn' => '<p>Даланзадгад суманд оршуулгын үйлчилгээг стандартын дагуу зохион байгуулах, дурсгал хүндэтгэлийн цогцолбор, ногоон байгууламж, зам талбай бүхий иж бүрэн цогцолбор байгуулна.</p><p><strong>Техник эдийн засгийн үндсэн үзүүлэлт:</strong></p><ul><li>Нийт талбай: 10 га;</li><li>Ногоон байгууламж: 60%-иас доошгүй;</li><li>Авто зогсоол: 50 машины багтаамжтай;</li><li>Дотоод авто замын урт: ойролцоогоор 850 м;</li><li>Урьдчилсан хөрөнгө оруулалтын хэмжээ: <strong>15 тэрбум төгрөг</strong>.</li></ul>',
                    'en' => '<p>A comprehensive complex will be built in Dalanzadgad soum to organize funeral services to standard, including a memorial complex, green space, and internal roads.</p><p><strong>Key technical and economic indicators:</strong></p><ul><li>Total area: 10 ha;</li><li>Green space: at least 60%;</li><li>Parking: capacity for 50 vehicles;</li><li>Internal road length: approximately 850 m;</li><li>Preliminary investment: <strong>MNT 15 billion</strong>.</li></ul>',
                ],
            ],

            [
                'slug' => 'nar-salkhi-100mvt',
                'title' => [
                    'mn' => 'Нар, салхины эрчим хүчээр 100 МВт хүртэл хүчин чадалтай цахилгаан станц барьж байгуулах',
                    'en' => 'Construction of a solar and wind power plant with capacity up to 100 MW',
                ],
                'cat' => 'erchim-khuch', 'status' => 'under_study',
            ],
            [
                'slug' => 'shokhoin-chuluu-uildver',
                'title' => ['mn' => 'Шохойн чулууны үйлдвэр байгуулах', 'en' => 'Limestone Processing Plant Development'],
                'cat' => 'azh-uildver', 'status' => 'under_study',
            ],
            [
                'slug' => 'khog-bolovsruulakh-uildver',
                'title' => [
                    'mn' => 'Хог хаягдлын менежментийг сайжруулж, хог боловсруулах үйлдвэрүүд байгуулах',
                    'en' => 'Improving waste management and establishing waste-processing plants',
                ],
                'cat' => 'niitiin-uilchilgee', 'status' => 'under_study',
            ],
            [
                'slug' => 'ars-shir-bolovsruulakh',
                'title' => ['mn' => 'Арьс шир боловсруулах үйлдвэр байгуулах', 'en' => 'Leather Processing Plant Development'],
                'cat' => 'azh-uildver', 'status' => 'under_study',
            ],
            [
                'slug' => 'avtozamyn-zasvar-archlalt',
                'title' => [
                    'mn' => 'Автозамын ашиглалт, засвар арчлалтыг хэрэгжүүлэх',
                    'en' => 'Road Operation and Maintenance Project',
                ],
                'cat' => 'deed-baiguulamj', 'status' => 'under_study',
            ],
            [
                'slug' => 'teever-logistikiin-tuv',
                'title' => [
                    'mn' => 'Ханбогд, Цогт-Овоо, Гурвантэс сумдад тээвэр, логистикийн төв байгуулах',
                    'en' => 'Establishing transport and logistics centers in Khanbogd, Tsogttsetsii and Gurvantes soums',
                ],
                'cat' => 'deed-baiguulamj', 'status' => 'under_study',
            ],
            [
                'slug' => 'tavantolgoi-dalanzadgad-tumor-zam',
                'title' => [
                    'mn' => 'Тавантолгой ордоос Даланзадгад сум хүртэлх төмөр зам барих',
                    'en' => 'Construction of a railway from the Tavan Tolgoi deposit to Dalanzadgad',
                ],
                'cat' => 'deed-baiguulamj', 'status' => 'under_study',
            ],
            [
                'slug' => 'dalanzadgad-gurvantes-zam',
                'title' => [
                    'mn' => 'Даланзадгад–Гурвантэс чиглэлийн автозамын засвар, арчлалтыг хариуцах компанийг сонгон шалгаруулах',
                    'en' => 'Selecting a company for maintenance of the Dalanzadgad–Gurvantes road',
                ],
                'cat' => 'deed-baiguulamj', 'status' => 'under_study',
            ],
            [
                'slug' => 'tsengeldekh-khureelen-10000',
                'title' => [
                    'mn' => '10 000 хүний суудалтай цэнгэлдэх хүрээлэн байгуулах',
                    'en' => 'Construction of a 10,000-seat stadium',
                ],
                'cat' => 'barilga-oron-suuts', 'status' => 'under_study',
            ],
            [
                'slug' => 'naishil-arena',
                'title' => [
                    'mn' => 'Чандмань /Найшил/ арена барилга байгуулах',
                    'en' => 'Construction of the Chandmani (Naishil) Arena',
                ],
                'cat' => 'barilga-oron-suuts', 'status' => 'under_study',
            ],
            [
                'slug' => 'usan-sport-tsogtsolbor',
                'title' => [
                    'mn' => 'Усан спорт цогцолборын барилга байгуулах',
                    'en' => 'Construction of an aquatic sports complex',
                ],
                'cat' => 'barilga-oron-suuts', 'status' => 'under_study',
            ],
            [
                'slug' => 'usan-park',
                'title' => ['mn' => 'Усан парк байгуулах', 'en' => 'Water Park Development'],
                'cat' => 'barilga-oron-suuts', 'status' => 'under_study',
            ],
            [
                'slug' => 'oron-suutsny-khotkhon-2000',
                'title' => [
                    'mn' => 'Даланзадгад, Ханбогд, Цогтцэций, Гурвантэс сумдад 2000-с дээш айлын орон сууцны хотхон барьж байгуулах',
                    'en' => 'Construction of housing complexes for over 2,000 households in Dalanzadgad, Khanbogd, Tsogttsetsii and Gurvantes soums',
                ],
                'cat' => 'barilga-oron-suuts', 'status' => 'under_study',
            ],
            [
                'slug' => 'niitiin-ded-butets',
                'title' => [
                    'mn' => 'Хувийн хэвшлийн хөрөнгө оруулалтаар нийтийн дэд бүтцийн бүтээн байгуулалт хийх',
                    'en' => 'Public infrastructure development through private investment',
                ],
                'cat' => 'deed-baiguulamj', 'status' => 'under_study',
            ],
            [
                'slug' => 'ayalal-julchlalyn-ded-butets',
                'title' => [
                    'mn' => 'Бүс нутгийн аялал жуулчлал, замын дагуух дэд бүтцийн бүтээн байгуулалт',
                    'en' => 'Regional tourism and roadside infrastructure development',
                ],
                'cat' => 'ayalal-julchlal', 'status' => 'under_study',
            ],
        ];

        foreach ($projects as $i => $p) {
            $titleMn = $p['title']['mn'];
            $titleEn = $p['title']['en'];

            Project::updateOrCreate(
                ['slug' => $p['slug']],
                [
                    ...$base,
                    'project_category_id' => $cats[$p['cat']]->id,
                    'title' => $p['title'],
                    'status' => $p['status'],
                    'phase' => [
                        'mn' => $p['status'] === 'pre_assessment' ? 'Урьдчилсан үнэлгээ' : 'Тандан судалгаа',
                        'en' => $p['status'] === 'pre_assessment' ? 'Pre-assessment' : 'Screening',
                    ],
                    'study_status' => [
                        'mn' => $p['status'] === 'pre_assessment' ? 'Урьдчилсан үнэлгээ хийгдсэн' : 'Судалгааны шатанд',
                        'en' => $p['status'] === 'pre_assessment' ? 'Pre-assessment completed' : 'Under study',
                    ],
                    'summary' => $p['summary'] ?? [
                        'mn' => $titleMn . '-ыг Өмнөговь аймагт төр, хувийн хэвшлийн түншлэлээр хэрэгжүүлэхээр батлагдсан.',
                        'en' => $titleEn . ' has been approved for implementation in Umnugovi Province through public–private partnership.',
                    ],
                    'body' => $p['body'] ?? [
                        'mn' => '<p>' . $titleMn . '-ыг Өмнөговь аймгийн Засаг даргын Тамгын газраас төр, хувийн хэвшлийн түншлэлээр хэрэгжүүлэхээр төлөвлөж, судалгааны ажлыг эхлүүлээд байна.</p>',
                        'en' => '<p>The Office of the Governor of Umnugovi Province is planning to implement ' . $titleEn . ' through public–private partnership, and preparatory studies have begun.</p>',
                    ],
                    'financing' => $p['financing'] ?? null,
                    'policy_reference' => [
                        'mn' => '<p>Өмнөговь аймагт төр, хувийн хэвшлийн түншлэлээр хэрэгжүүлэхээр батлагдсан төслүүдийн жагсаалтад тусгагдсан.</p>',
                        'en' => '<p>Included in the list of projects approved for implementation in Umnugovi Province through public–private partnership.</p>',
                    ],
                    'is_featured' => $p['featured'] ?? false,
                    'published_at' => Carbon::now()->subDays($i + 2),
                ],
            );
        }
    }
}
