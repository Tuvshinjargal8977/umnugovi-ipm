<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'greeting',
                'title' => ['mn' => 'Мэндчилгээ', 'en' => 'Greeting'],
                'sort' => 1,
                'body' => [
                    'mn' => <<<'HTML'
<p>Эрхэм хүндэт иргэд, хөрөнгө оруулагчид, хамтран ажиллагсад аа,</p>
<p>Өмнөговь аймаг бол Монгол Улсын эдийн засгийн тулгуур бүс нутгийн нэг. Уул уурхай, эрчим хүч, тээвэр логистик, аялал жуулчлалын асар их боломжийг иргэдийнхээ амьдралын чанарт шингээх нь бидний зорилго.</p>
<p>Төслийн нэгдсэн удирдлагын газар нь аймагтаа хэрэгжих томоохон төслүүдийг <strong>нэгдсэн төлөвлөлт, ил тод байдал, хувийн хэвшлийн оролцоотойгоор</strong> хэрэгжүүлэхэд хүчин зүтгэж байна. Бид хамтдаа Өмнөговийг илүү таатай амьдрах, бизнес эрхлэх орчинтой болгоно гэдэгт итгэлтэй байна.</p>
<p>Хамтын ажиллагаанд уриалж байна.</p>
<p><em>Өмнөговь аймгийн Төслийн нэгдсэн удирдлагын газар</em></p>
HTML,
                    'en' => <<<'HTML'
<p>Dear citizens, investors and partners,</p>
<p>Umnugovi Province is one of Mongolia's key economic regions. Turning its vast potential in mining, energy, transport & logistics and tourism into a better quality of life for our people is our goal.</p>
<p>The Integrated Project Management Office works to deliver the province's major projects through <strong>unified planning, transparency and private-sector participation</strong>. Together, we are confident we can make Umnugovi a better place to live and do business.</p>
<p>We invite you to work with us.</p>
<p><em>Integrated Project Management Office, Umnugovi Province</em></p>
HTML,
                ],
            ],
            [
                'slug' => 'about-us',
                'title' => ['mn' => 'Танилцуулга', 'en' => 'About us'],
                'sort' => 2,
                'body' => [
                    'mn' => <<<'HTML'
<p>Өмнөговь аймгийн Төслийн нэгдсэн удирдлагын газар (IPM — Integrated Project Management) нь аймгийн хэмжээнд хэрэгжүүлэх хөрөнгө оруулалт, дэд бүтэц, төр хувийн хэвшлийн түншлэлийн төслүүдийг тандан судлах, үнэлэх, боловсруулах, сонгон шалгаруулах, хэрэгжилтэд хяналт тавих үйл ажиллагааг нэгдсэн удирдлагаар хангах чиг үүрэгтэй байгууллага юм.</p>
<p><strong>Нэг байршил + нэгдсэн төлөвлөлт + дэд бүтэц + аюулгүй орчин + олон төрлийн худалдаа, үйлчилгээ</strong> — энэ бол бидний ажлын гол зарчим.</p>
<h3>Үйл ажиллагааны чиглэл</h3>
<ul>
<li>Эрчим хүч, сэргээгдэх эрчим хүчний төслүүд;</li>
<li>Авто зам, төмөр зам, тээвэр логистикийн дэд бүтэц;</li>
<li>Худалдаа, үйлчилгээ, зах зээлийн дэд бүтэц;</li>
<li>Орон сууц, нийтийн аж ахуй, спорт цэнгэлдэхийн байгууламж;</li>
<li>Хөдөө аж ахуй, аж үйлдвэр, аялал жуулчлал.</li>
</ul>
<h3>Өнөөгийн байдал</h3>
<p>Өмнөговь аймагт төр хувийн хэвшлийн түншлэлээр хэрэгжүүлэхээр <strong>20 төсөл</strong> батлагдсан бөгөөд эдгээрээс <strong>5 төслийн</strong> урьдчилсан үнэлгээ хийгдэж дууссан: «Худалдааны төв зах», Шар тээгийн уулзварын тээвэрчдийн үйлчилгээний төв, Гурвансайхан нисэх буудал, оршуулгын үйлчилгээ, өндөгний аж ахуй.</p>
HTML,
                    'en' => <<<'HTML'
<p>The Integrated Project Management Office (IPM) of Umnugovi Province identifies, assesses, prepares, tenders and monitors provincial investment, infrastructure and public–private partnership (PPP) projects under unified management.</p>
<p><strong>One location + integrated planning + infrastructure + a safe environment + diverse trade and services</strong> — this is the core principle behind our work.</p>
<h3>Areas of activity</h3>
<ul>
<li>Energy and renewable-energy projects;</li>
<li>Roads, railways, transport and logistics infrastructure;</li>
<li>Trade, services and market infrastructure;</li>
<li>Housing, public utilities, and sports and recreation facilities;</li>
<li>Agriculture, manufacturing and tourism.</li>
</ul>
<h3>Current status</h3>
<p><strong>20 projects</strong> have been approved for implementation through public–private partnership in Umnugovi Province, of which <strong>5 projects</strong> have completed pre-assessment: the "Trade Center Market", the Shar Teeg Junction trucker services center, Gurvansaikhan Airport, funeral services, and the egg farm.</p>
HTML,
                ],
            ],
            [
                'slug' => 'vision-mission',
                'title' => ['mn' => 'Алсын хараа, эрхэм зорилго', 'en' => 'Vision & mission'],
                'sort' => 3,
                'body' => [
                    'mn' => <<<'HTML'
<h3>Алсын хараа</h3>
<p>Өмнөговь аймгийг Монгол Улсын хөгжлийн бодлогод нийцсэн, олон улсын жишигт хүрсэн, ил тод, үр ашигтай төсөл хэрэгжүүлэлтийн загвар аймаг болгох.</p>
<h3>Эрхэм зорилго</h3>
<p>Дэд бүтэц, эрчим хүч, худалдаа, үйлчилгээ, нийгмийн салбарын төслүүдийг төр хувийн хэвшлийн түншлэлээр үр дүнтэй хэрэгжүүлэхэд дэмжлэг үзүүлэх.</p>
<h3>Стратегийн зорилтууд</h3>
<ul>
<li>Аймгийн хөгжлийн тэргүүлэх чиглэлд нийцсэн төслийн нэгдсэн санг бүрдүүлэх;</li>
<li>Төсөл боловсруулалт, үнэлгээний чадавхыг бэхжүүлэх;</li>
<li>Хөрөнгө оруулагчдад нээлттэй, ил тод мэдээллийн орчин бий болгох;</li>
<li>Гэрээний эрсдэлийн удирдлага, хяналтын тогтолцоог хөгжүүлэх.</li>
</ul>
HTML,
                    'en' => <<<'HTML'
<h3>Vision</h3>
<p>To make Umnugovi Province a model for transparent, efficient project delivery, aligned with national development policy and international best practice.</p>
<h3>Mission</h3>
<p>To support the effective delivery of infrastructure, energy, trade, services and social-sector projects through public–private partnership.</p>
<h3>Strategic objectives</h3>
<ul>
<li>Build a unified pipeline of projects aligned with the province's development priorities;</li>
<li>Strengthen project preparation and appraisal capacity;</li>
<li>Create an open, transparent information environment for investors;</li>
<li>Develop a robust system for contract risk management and monitoring.</li>
</ul>
HTML,
                ],
            ],
            [
                'slug' => 'mandate',
                'title' => ['mn' => 'Чиг үүрэг', 'en' => 'Mandate'],
                'sort' => 4,
                'body' => [
                    'mn' => <<<'HTML'
<p>Төслийн нэгдсэн удирдлагын газар нь Төр, хувийн хэвшлийн түншлэлийн тухай хууль болон аймгийн Засаг даргын шийдвэрийн дагуу дараах үндсэн чиг үүргийг хэрэгжүүлнэ:</p>
<ol>
<li><strong>Тандан судалгаа.</strong> Түншлэлийн төсөл болох боломжтой санаачилгыг цуглуулах, эрэмбэлэх;</li>
<li><strong>Урьдчилсан үнэлгээ.</strong> Төслийн техник, эдийн засаг, эрх зүй, санхүүгийн урьдчилсан үнэлгээ хийх;</li>
<li><strong>Бүрэн шинжилгээ.</strong> Мөнгөний үнэ цэнэ, эрсдэлийн хуваарилалт, төслийн бүтцийг тодорхойлох;</li>
<li><strong>Сонгон шалгаруулалт.</strong> Хувийн хэвшлийн түншлэгч, зөвлөх үйлчилгээг нээлттэй, ил тод сонгон шалгаруулах;</li>
<li><strong>Гэрээ.</strong> Түншлэлийн гэрээ байгуулах, санхүүгийн болзол хаах ажиллагааг дэмжих;</li>
<li><strong>Хяналт.</strong> Гэрээний хэрэгжилт, гүйцэтгэлийн үзүүлэлт, санхүүжилт, тайлагналд хяналт тавих.</li>
</ol>
HTML,
                    'en' => <<<'HTML'
<p>Under the Law on Public–Private Partnership and decisions of the provincial governor, the Integrated Project Management Office carries out the following core functions:</p>
<ol>
<li><strong>Screening.</strong> Collecting and prioritizing initiatives that could become partnership projects;</li>
<li><strong>Pre-assessment.</strong> Conducting preliminary technical, economic, legal and financial assessment of projects;</li>
<li><strong>Full appraisal.</strong> Determining value for money, risk allocation and project structure;</li>
<li><strong>Tendering.</strong> Running open, transparent selection of private partners and advisory services;</li>
<li><strong>Contracting.</strong> Supporting the signing of partnership agreements and closing financial conditions;</li>
<li><strong>Monitoring.</strong> Overseeing contract implementation, performance indicators, financing and reporting.</li>
</ol>
HTML,
                ],
            ],
            [
                'slug' => 'structure',
                'title' => ['mn' => 'Бүтэц, зохион байгуулалт', 'en' => 'Structure'],
                'sort' => 5,
                'body' => [
                    'mn' => <<<'HTML'
<p>Төслийн нэгдсэн удирдлагын газар нь дараах нэгжүүдээс бүрдэнэ:</p>
<ul>
<li><strong>Захирлын алба</strong> — нийт үйл ажиллагааны удирдлага, зохицуулалт;</li>
<li><strong>Төсөл боловсруулалт, үнэлгээний хэлтэс</strong> — тандан судалгаа, урьдчилсан үнэлгээ, бүрэн шинжилгээ;</li>
<li><strong>Хөрөнгө оруулалт, гэрээ хариуцсан хэлтэс</strong> — сонгон шалгаруулалт, гэрээ, санхүүгийн зохицуулалт;</li>
<li><strong>Хяналт-шинжилгээ, мэдээллийн технологийн алба</strong> — хэрэгжилтийн хяналт, тайлагнал, цахим үйлчилгээ;</li>
<li><strong>Захиргаа, санхүүгийн алба</strong> — хүний нөөц, санхүү, дотоод үйл ажиллагаа.</li>
</ul>
<p>Орон тооны хязгаар болон дэлгэрэнгүй бүтцийг аймгийн Засаг даргын захирамжаар батална.</p>
HTML,
                    'en' => <<<'HTML'
<p>The Integrated Project Management Office is composed of the following units:</p>
<ul>
<li><strong>Director's office</strong> — overall management and coordination;</li>
<li><strong>Project Preparation & Appraisal Department</strong> — screening, pre-assessment and full appraisal;</li>
<li><strong>Investment & Contracts Department</strong> — tendering, contracting and financial structuring;</li>
<li><strong>Monitoring & IT Department</strong> — implementation oversight, reporting and e-services;</li>
<li><strong>Administration & Finance Department</strong> — human resources, finance and internal operations.</li>
</ul>
<p>Staffing levels and the detailed structure are approved by order of the provincial governor.</p>
HTML,
                ],
            ],
            [
                'slug' => 'hr-transparency',
                'title' => ['mn' => 'Хүний нөөцийн ил тод байдал', 'en' => 'HR transparency'],
                'sort' => 6,
                'body' => [
                    'mn' => <<<'HTML'
<p>Байгууллага нь төрийн албаны тухай хууль, холбогдох журмын дагуу хүний нөөцийн бодлогоо ил тод, шударга явуулна.</p>
<h2>Нээлттэй ажлын байр</h2>
<p>Сул орон тооны зар, шалгаруулалтын үр дүнг «Мэдээ мэдээлэл → Хүний нөөц» хэсэгт нийтэлнэ.</p>
<h2>Сонгон шалгаруулалтын журам</h2>
<ul>
<li>Зар нийтлэх — 10-аас доошгүй ажлын өдөр;</li>
<li>Баримт бичгийн бүрдэл шалгах;</li>
<li>Мэдлэг чадварын болон ярилцлагын шат;</li>
<li>Үр дүнг нээлттэй мэдээлэх.</li>
</ul>
<h2>Албан хаагчийн ёс зүй</h2>
<p>Албан хаагчид Төрийн албан хаагчийн ёс зүйн дүрмийг мөрдөнө. Ёс зүйн зөрчлийн талаарх мэдээллийг байгууллагын албан ёсны хаягаар хүлээн авна.</p>
HTML,
                    'en' => <<<'HTML'
<p>The office conducts its HR policy transparently and fairly, in accordance with the Civil Service Law and related regulations.</p>
<h2>Open vacancies</h2>
<p>Vacancy announcements and selection results are published under News → Human Resources.</p>
<h2>Selection procedure</h2>
<ul>
<li>Vacancy announced — at least 10 working days;</li>
<li>Document completeness check;</li>
<li>Written assessment and interview stage;</li>
<li>Results announced openly.</li>
</ul>
<h2>Staff code of conduct</h2>
<p>Staff follow the Code of Ethics for Civil Servants. Reports of ethics violations are received through the office's official contact channels.</p>
HTML,
                ],
            ],
            [
                'slug' => 'rules',
                'title' => ['mn' => 'Дүрэм, журам', 'en' => 'Rules & regulations'],
                'sort' => 7,
                'body' => [
                    'mn' => <<<'HTML'
<p>Үйл ажиллагаанд мөрдөгдөх үндсэн журмууд:</p>
<ul>
<li>Байгууллагын дүрэм;</li>
<li>Түншлэлийн төслийг санаачлах, бүртгэх журам;</li>
<li>Урьдчилсан үнэлгээ хийх аргачлал;</li>
<li>Мөнгөний үнэ цэнийн шинжилгээ хийх аргачлал;</li>
<li>Хувийн хэвшлийн түншлэгч сонгон шалгаруулах журам;</li>
<li>Гэрээний хэрэгжилтэд хяналт тавих журам;</li>
<li>Мэдээллийн ил тод байдал, цахим үйлчилгээний журам.</li>
</ul>
<p>Хууль, журмын нэгдсэн эмхэтгэлийг <a href="https://legalinfo.mn" target="_blank" rel="noopener">legalinfo.mn</a>-ээс үзнэ үү.</p>
HTML,
                    'en' => <<<'HTML'
<p>Core regulations governing the office's activities:</p>
<ul>
<li>The office charter;</li>
<li>Rules for initiating and registering partnership projects;</li>
<li>Pre-assessment methodology;</li>
<li>Value-for-money analysis methodology;</li>
<li>Private partner selection rules;</li>
<li>Contract implementation monitoring rules;</li>
<li>Information transparency and e-service rules.</li>
</ul>
<p>See the full collection of laws and regulations at <a href="https://legalinfo.mn" target="_blank" rel="noopener">legalinfo.mn</a>.</p>
HTML,
                ],
            ],
            [
                'slug' => 'laws',
                'title' => ['mn' => 'Хууль, эрх зүй', 'en' => 'Laws & regulations'],
                'sort' => 8,
                'body' => [
                    'mn' => <<<'HTML'
<p>Төр, хувийн хэвшлийн түншлэлийн үйл ажиллагаа дараах эрх зүйн баримт бичгүүдэд тулгуурлана:</p>
<ul>
<li><strong>Төр, хувийн хэвшлийн түншлэлийн тухай хууль</strong> (2022 он);</li>
<li>Түншлэлийн төслийг санаачлах, боловсруулах, сонгон шалгаруулах журам;</li>
<li>Урьдчилсан үнэлгээ, мөнгөний үнэ цэнийн шинжилгээ хийх аргачлал;</li>
<li>Гэрээний загвар, ерөнхий нөхцөл;</li>
<li>«Алсын хараа-2050» урт хугацааны хөгжлийн бодлого;</li>
<li>Засгийн газрын 2024–2028 оны үйл ажиллагааны хөтөлбөр.</li>
</ul>
<p>Дэлгэрэнгүй мэдээллийг <a href="https://legalinfo.mn" target="_blank" rel="noopener">legalinfo.mn</a> цахим хуудаснаас авна уу.</p>
HTML,
                    'en' => <<<'HTML'
<p>Public–private partnership activity is based on the following legal documents:</p>
<ul>
<li><strong>Law on Public–Private Partnership</strong> (2022);</li>
<li>Rules for initiating, preparing and tendering partnership projects;</li>
<li>Pre-assessment and value-for-money analysis methodology;</li>
<li>Standard contract template and general terms;</li>
<li>"Vision 2050" long-term development policy;</li>
<li>Government Action Plan 2024–2028.</li>
</ul>
<p>For more information, see <a href="https://legalinfo.mn" target="_blank" rel="noopener">legalinfo.mn</a>.</p>
HTML,
                ],
            ],
            [
                'slug' => 'faq',
                'title' => ['mn' => 'Түгээмэл асуулт, хариулт', 'en' => 'FAQ'],
                'sort' => 9,
                'body' => [
                    'mn' => <<<'HTML'
<h2>Түншлэлийн төсөл гэж юу вэ?</h2>
<p>Төр, хувийн хэвшлийн байгууллага урт хугацааны гэрээний үндсэн дээр эрсдэл, үүргээ хуваарилан дэд бүтэц, нийгмийн үйлчилгээг хамтран бий болгож, ашиглуулахыг хэлнэ.</p>
<h2>Төсөл санаачлахад юу шаардлагатай вэ?</h2>
<p>Төслийн санаа, урьдчилсан техник, эдийн засгийн тооцоо, санхүүжилтийн бүтцийн саналыг Төслийн нэгдсэн удирдлагын газарт ирүүлнэ.</p>
<h2>Сонгон шалгаруулалт хэрхэн явагддаг вэ?</h2>
<p>Урьдчилсан үнэлгээ → бүрэн шинжилгээ → нээлттэй зарлал → санал хүлээн авах → үнэлгээ → хэлэлцээр → гэрээ байгуулах дарааллаар явагдана.</p>
<h2>Санал хаана ирүүлэх вэ?</h2>
<p>Төслийг сонирхсон саналаа «Холбоо барих» хэсгийн маягтаар эсвэл байгууллагын албан ёсны хаягаар ирүүлнэ.</p>
HTML,
                    'en' => <<<'HTML'
<h2>What is a PPP project?</h2>
<p>A long-term contract in which the public and private sectors share risks and responsibilities to jointly build and operate infrastructure or public services.</p>
<h2>What is needed to propose a project?</h2>
<p>Submit the project concept, preliminary technical and economic estimates, and a proposed financing structure to the Integrated Project Management Office.</p>
<h2>How does the tender process work?</h2>
<p>It follows this sequence: pre-assessment → full appraisal → public announcement → receiving proposals → evaluation → negotiation → contract signing.</p>
<h2>Where do I submit a proposal?</h2>
<p>Submit your proposal through the "Contact us" form, or send it to the office's official address.</p>
HTML,
                ],
            ],
        ];

        foreach ($pages as $p) {
            Page::updateOrCreate(['slug' => $p['slug']], $p);
        }
    }
}
