import { Link, usePage } from '@inertiajs/react';
import type { SharedProps } from '@/types';
import Container from './Container';
import Brand from './Brand';

function tel(v: string) {
    return 'tel:' + v.replace(/[^0-9+]/g, '');
}

const cols: { title: string; links: { label: string; href: string }[] }[] = [
    {
        title: 'Бидний тухай',
        links: [
            { label: 'Мэндчилгээ', href: '/greeting' },
            { label: 'Танилцуулга', href: '/about-us' },
            { label: 'Алсын хараа, эрхэм зорилго', href: '/vision-mission' },
            { label: 'Чиг үүрэг', href: '/mandate' },
            { label: 'Бүтэц, зохион байгуулалт', href: '/structure' },
        ],
    },
    {
        title: 'Хууль, эрх зүй',
        links: [
            { label: 'Хууль, эрх зүй', href: '/laws' },
            { label: 'Дүрэм, журам', href: '/rules' },
            { label: 'Түгээмэл асуулт, хариулт', href: '/faq' },
        ],
    },
    {
        title: 'Ил тод байдал',
        links: [
            { label: 'Төслийн нэгдсэн сан', href: '/projects' },
            { label: 'Хүний нөөцийн ил тод байдал', href: '/hr-transparency' },
            { label: 'Сонгон шалгаруулалт', href: '/posts?category=songon-shalgaruulalt' },
        ],
    },
    {
        title: 'Төслүүд',
        links: [
            { label: 'Бүх төслүүд', href: '/projects' },
            { label: 'Санал авч буй', href: '/projects?status=open_for_proposals' },
            { label: 'Мэдээ мэдээлэл', href: '/posts' },
            { label: 'Холбоо барих', href: '/contact-us' },
        ],
    },
];

export default function Footer() {
    const { site } = usePage<SharedProps>().props;
    const year = new Date().getFullYear();

    return (
        <footer className="bg-gradient-to-br from-brand-900 to-brand-500 text-white">
            <Container className="py-12">
                <div className="mb-10 flex flex-col gap-3 border-b border-white/15 pb-8">
                    <div className="w-fit rounded-lg bg-white/10 p-3 ring-1 ring-white/15">
                        <Brand variant="footer" />
                    </div>
                    <p className="max-w-xl text-[0.75rem] text-white/80">
                        Өмнөговь аймагт төр, хувийн хэвшлийн түншлэлээр хэрэгжүүлэх төслүүдийн нэгдсэн мэдээллийн эх сурвалж.
                    </p>
                </div>
                <div className="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                    <div className="flex flex-col gap-8">
                        {cols.slice(0, 2).map((c) => (
                            <FooterCol key={c.title} {...c} />
                        ))}
                    </div>
                    <div className="flex flex-col gap-8">
                        {cols.slice(2).map((c) => (
                            <FooterCol key={c.title} {...c} />
                        ))}
                    </div>

                    <div className="flex flex-col gap-8">
                        <div>
                            <FooterTitle>Холбоо барих</FooterTitle>
                            <ul className="flex flex-col gap-2 text-[0.72rem]">
                                <li className="not-italic leading-relaxed">
                                    <i className="bi bi-geo-alt-fill mr-2" />
                                    {site.address}
                                </li>
                                <li>
                                    <a href={`mailto:${site.email}`} className="hover:text-white/75">
                                        <i className="bi bi-envelope-fill mr-2" />
                                        {site.email}
                                    </a>
                                </li>
                                <li>
                                    <a href={tel(site.phone)} className="hover:text-white/75">
                                        <i className="bi bi-telephone-fill mr-2" />
                                        {site.phone}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <FooterTitle>Бидэнтэй нэгдэх</FooterTitle>
                            <div className="flex gap-3">
                                {['facebook', 'twitter-x', 'youtube'].map((i) => (
                                    <a
                                        key={i}
                                        href={site.facebook || '#'}
                                        className="flex h-8 w-8 items-center justify-center rounded-full border border-white/25 hover:bg-white/10"
                                    >
                                        <i className={`bi bi-${i}`} />
                                    </a>
                                ))}
                            </div>
                        </div>
                    </div>

                    <div>
                        <FooterTitle>Газрын зураг</FooterTitle>
                        <iframe
                            src={site.mapEmbed}
                            loading="lazy"
                            className="aspect-[16/9] w-full rounded-lg border-0"
                        />
                    </div>
                </div>
            </Container>

            <div className="border-t border-white/15 bg-brand-950/60">
                <Container className="flex flex-col gap-1 py-3 text-[0.68rem] md:flex-row md:justify-between">
                    <span>Бүх эрх хуулиар хамгаалагдсан © {year}. {site.name}</span>
                    <span>Laravel · Inertia · React</span>
                </Container>
            </div>
        </footer>
    );
}

function FooterTitle({ children }: { children: React.ReactNode }) {
    return (
        <h4 className="mb-4 flex items-center gap-3 text-[0.72rem] font-bold uppercase text-white">
            {children}
            <span className="h-px flex-1 bg-gradient-to-r from-white/80 to-transparent" />
        </h4>
    );
}

function FooterCol({ title, links }: { title: string; links: { label: string; href: string }[] }) {
    return (
        <div>
            <FooterTitle>{title}</FooterTitle>
            <ul className="flex flex-col gap-2 text-[0.72rem]">
                {links.map((l, i) => (
                    <li key={i}>
                        <Link href={l.href} className="hover:text-white/75">
                            {l.label}
                        </Link>
                    </li>
                ))}
            </ul>
        </div>
    );
}
