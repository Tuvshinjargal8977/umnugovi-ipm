<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        $catDefs = [
            ['Мэдээ мэдээлэл', 'News', 'medee-medeelel', 1],
            ['Сонгон шалгаруулалт', 'Selection', 'songon-shalgaruulalt', 2],
            ['Хүний нөөц', 'Human resources', 'khunii-noots', 3],
            ['Зарлал', 'Announcements', 'zarlal', 4],
            ['Арга хэмжээ', 'Events', 'arga-khemjee', 5],
            ['Хууль, эрх зүй', 'Laws & regulations', 'khuuli-erh-zui', 6],
            ['Дүрэм журам', 'Rules', 'durem-juram', 7],
            ['Орон нутаг', 'Local', 'oron-nutag', 8],
        ];
        $cats = [];
        foreach ($catDefs as [$nameMn, $nameEn, $slug, $sort]) {
            $cats[$slug] = PostCategory::updateOrCreate(
                ['slug' => $slug],
                ['name' => ['mn' => $nameMn, 'en' => $nameEn], 'sort' => $sort],
            );
        }

        $posts = [
            [
                'mn' => [
                    'title' => 'Өмнөговь аймагт төр, хувийн хэвшлийн түншлэлээр хэрэгжүүлэх 20 төслийн жагсаалт батлагдлаа',
                    'excerpt' => 'Аймгийн Засаг даргын захирамжаар эрчим хүч, дэд бүтэц, худалдаа, барилга, аж үйлдвэрийн 20 төслийг ТХХТ-ээр хэрэгжүүлэхээр баталлаа.',
                ],
                'en' => [
                    'title' => '20 public–private partnership projects approved in Umnugovi Province',
                    'excerpt' => 'By order of the provincial governor, 20 energy, infrastructure, trade, construction and manufacturing projects were approved for implementation through PPP.',
                ],
                'cat' => 'medee-medeelel',
            ],
            [
                'mn' => [
                    'title' => '5 төслийн урьдчилсан үнэлгээ хийгдэж дуусав',
                    'excerpt' => 'Худалдааны төв зах, Шар тээгийн тээвэрчдийн төв, Гурвансайхан нисэх буудал, оршуулгын үйлчилгээ, өндөгний аж ахуйн төслүүдийн урьдчилсан үнэлгээ дуусав.',
                ],
                'en' => [
                    'title' => 'Pre-assessment completed for 5 projects',
                    'excerpt' => 'Pre-assessment has been completed for the Trade Center Market, the Shar Teeg trucker services center, Gurvansaikhan Airport, funeral services, and the egg farm.',
                ],
                'cat' => 'medee-medeelel',
            ],
            [
                'mn' => [
                    'title' => '“Худалдааны төв зах” төслийн танилцуулга уулзалт болно',
                    'excerpt' => 'Даланзадгад хотод байгуулах “Худалдааны төв зах” төслийн талаар хөрөнгө оруулагч, иргэдэд мэдээлэл өгөх уулзалт зохион байгуулагдана.',
                ],
                'en' => [
                    'title' => 'Information session on the "Trade Center Market" project',
                    'excerpt' => 'An information session for investors and residents will be held on the proposed "Trade Center Market" project in Dalanzadgad.',
                ],
                'cat' => 'arga-khemjee',
            ],
            [
                'mn' => [
                    'title' => 'Гурвансайхан нисэх буудлын төслийн санал хүлээн авч эхэллээ',
                    'excerpt' => 'Өмнөговь аймгийн Гурвансайхан нисэх буудлыг 4D ангилалд шилжүүлэх төслийн санал авах хугацаа 2026 оны 4 дүгээр сарын 13 хүртэл.',
                ],
                'en' => [
                    'title' => 'Proposals now open for the Gurvansaikhan Airport project',
                    'excerpt' => 'Proposals are being accepted until 13 April 2026 for the project to upgrade Gurvansaikhan Airport in Umnugovi Province to category 4D.',
                ],
                'cat' => 'zarlal',
            ],
            [
                'mn' => [
                    'title' => 'Автозамын засвар, арчлалтын компани сонгон шалгаруулна',
                    'excerpt' => 'Даланзадгад–Гурвантэс чиглэлийн автозамын засвар, арчлалтыг хариуцах компанийн сонгон шалгаруулалт зарлагдана.',
                ],
                'en' => [
                    'title' => 'Tender announced for road maintenance contractor',
                    'excerpt' => 'A tender will be held to select the company responsible for maintenance of the Dalanzadgad–Gurvantes road.',
                ],
                'cat' => 'songon-shalgaruulalt',
            ],
            [
                'mn' => [
                    'title' => 'Ажлын байрны зар: Төслийн шинжээч',
                    'excerpt' => 'Өмнөговь аймгийн Төслийн нэгдсэн удирдлагын газарт төслийн шинжээч сонгон шалгаруулж авна.',
                ],
                'en' => [
                    'title' => 'Vacancy: Project Specialist',
                    'excerpt' => 'The Integrated Project Management Office of Umnugovi Province is hiring a project specialist.',
                ],
                'cat' => 'khunii-noots',
            ],
        ];

        foreach ($posts as $i => $p) {
            Post::updateOrCreate(
                ['slug' => 'medee-' . ($i + 1)],
                [
                    'post_category_id' => $cats[$p['cat']]->id,
                    'title' => ['mn' => $p['mn']['title'], 'en' => $p['en']['title']],
                    'excerpt' => ['mn' => $p['mn']['excerpt'], 'en' => $p['en']['excerpt']],
                    'body' => [
                        'mn' => '<p>Дэлгэрэнгүй мэдээллийг Өмнөговь аймгийн Төслийн нэгдсэн удирдлагын газраас авна уу.</p>',
                        'en' => '<p>For more information, please contact the Integrated Project Management Office of Umnugovi Province.</p>',
                    ],
                    'author' => 'Өмнөговь аймгийн Төслийн нэгдсэн удирдлагын газар',
                    'published_at' => Carbon::now()->subDays($i * 2 + 1),
                ],
            );
        }
    }
}
