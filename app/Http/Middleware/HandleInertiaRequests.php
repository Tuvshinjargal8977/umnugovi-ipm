<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        return [
            ...parent::share($request),

            'site' => [
                'name' => 'Өмнөговь аймгийн төслийн нэгдсэн удирдлагын газар',
                'nameShort' => 'IPM',
                'emblem' => '/images/emblem-official.jpg', // Байгууллагын албан ёсны IPM тэмдэг (эх сурвалж: gov.mn/org/integrated)
                'logo' => '/images/ipm-logo.svg',       // IPM wordmark
                'phone' => '(+976) 7053-0012',
                'email' => 'ipmo@omnogovi.gov.mn',
                'address' => 'Өмнөговь аймаг, Даланзадгад сум, Далан 3 дугаар баг, Нутгийн удирдлагын ордон, 105, 114 тоот',
                'facebook' => null,
                'mapEmbed' => 'https://maps.google.com/maps?q=43.5708,104.4250&hl=mn&z=13&output=embed',
                'heroImage' => '/images/hero-bg.svg',
            ],

            'nav' => [
                ['label' => 'Бидний тухай', 'children' => [
                    ['label' => 'Мэндчилгээ', 'url' => '/greeting'],
                    ['label' => 'Танилцуулга', 'url' => '/about-us'],
                    ['label' => 'Алсын хараа, эрхэм зорилго', 'url' => '/vision-mission'],
                    ['label' => 'Чиг үүрэг', 'url' => '/mandate'],
                    ['label' => 'Бүтэц, зохион байгуулалт', 'url' => '/structure'],
                ]],
                ['label' => 'Хууль, эрх зүй', 'children' => [
                    ['label' => 'Хууль, эрх зүй', 'url' => '/laws'],
                    ['label' => 'Дүрэм, журам', 'url' => '/rules'],
                    ['label' => 'Түншлэлийн тухай хууль', 'url' => 'https://legalinfo.mn'],
                ]],
                ['label' => 'Мэдээлэл', 'children' => [
                    ['label' => 'Мэдээ мэдээлэл', 'url' => '/posts'],
                    ['label' => 'Арга хэмжээ', 'url' => '/posts?category=arga-khemjee'],
                    ['label' => 'Зарлал', 'url' => '/posts?category=zarlal'],
                    ['label' => 'Орон нутаг', 'url' => '/posts?category=oron-nutag'],
                ]],
                ['label' => 'Ил тод байдал', 'children' => [
                    ['label' => 'Төслийн нэгдсэн сан', 'url' => '/projects'],
                    ['label' => 'Хүний нөөцийн ил тод байдал', 'url' => '/hr-transparency'],
                    ['label' => 'Сонгон шалгаруулалт', 'url' => '/posts?category=songon-shalgaruulalt'],
                    ['label' => 'Шилэн данс', 'url' => 'https://shilendans.gov.mn'],
                ]],
                ['label' => 'Төслүүд', 'children' => [
                    ['label' => 'Бүх төслүүд', 'url' => '/projects'],
                    ['label' => 'Санал авч буй', 'url' => '/projects?status=open_for_proposals'],
                    ['label' => 'Урьдчилсан үнэлгээ хийгдсэн', 'url' => '/projects?status=pre_assessment'],
                    ['label' => 'Судлагдаж буй', 'url' => '/projects?status=under_study'],
                    ['label' => 'Түншлэлийн төслийн үе шат', 'url' => '/projects'],
                ]],
                ['label' => 'Түгээмэл асуулт', 'url' => '/faq'],
                ['label' => 'Холбоо барих', 'url' => '/contact-us'],
            ],

            'locale' => app()->getLocale(),
            'locales' => \App\Http\Middleware\SetLocale::SUPPORTED,

            'flash' => [
                'success' => fn () => $request->hasSession() && $request->session()->get('contact_sent')
                    ? 'Таны хүсэлт амжилттай илгээгдлээ. Баярлалаа!'
                    : null,
                'proposalSent' => fn () => $request->hasSession() && $request->session()->get('proposal_sent')
                    ? 'Таны санал амжилттай илгээгдлээ. Баярлалаа!'
                    : null,
            ],
        ];
    }
}
