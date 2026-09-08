import { Head, usePage } from '@inertiajs/react';
import type { SharedProps } from '@/types';

interface SeoProps {
    /** Хуудасны нэр (байгууллагын нэр автоматаар нэмэгдэнэ) */
    title?: string;
    /** meta description ба og:description */
    description?: string;
    /** og:image — үнэмлэхүй эсвэл эхнээс нь / -тэй зам */
    image?: string | null;
    type?: 'website' | 'article';
    /** Хайлтын системд индекслүүлэхгүй (жишээ нь дотоод хайлтын хуудас) */
    noindex?: boolean;
}

const DEFAULT_DESC =
    'Өмнөговь аймагт төр, хувийн хэвшлийн түншлэлээр хэрэгжүүлэх төслүүдийн нэгдсэн мэдээлэл — Төслийн удирдлагын газар (IPM).';

function abs(path: string): string {
    if (/^https?:\/\//.test(path)) return path;
    if (typeof window === 'undefined') return path;
    return window.location.origin + (path.startsWith('/') ? path : '/' + path);
}

/**
 * Хуудас бүрийн title, description, Open Graph / canonical шошгыг удирдана.
 * Inertia-гийн <Head> нь хуудас солигдоход эдгээрийг шинэчилдэг.
 */
export default function Seo({ title, description, image, type = 'website', noindex = false }: SeoProps) {
    const { site } = usePage<SharedProps>().props;

    const desc = (description || DEFAULT_DESC)
        .replace(/<[^>]*>/g, ' ')
        .replace(/\s+/g, ' ')
        .trim()
        .slice(0, 300);
    const fullTitle = title ? `${title} — ${site.name}` : site.name;
    const url = typeof window !== 'undefined' ? window.location.href.split('#')[0] : '';
    const img = abs(image || '/images/hero-bg.svg');

    return (
        <Head title={title}>
            <meta head-key="description" name="description" content={desc} />
            <meta head-key="og:title" property="og:title" content={fullTitle} />
            <meta head-key="og:description" property="og:description" content={desc} />
            <meta head-key="og:type" property="og:type" content={type} />
            <meta head-key="og:image" property="og:image" content={img} />
            <meta head-key="twitter:card" name="twitter:card" content="summary_large_image" />
            {noindex && <meta head-key="robots" name="robots" content="noindex, follow" />}
            {url && <meta head-key="og:url" property="og:url" content={url} />}
            {url && <link head-key="canonical" rel="canonical" href={url} />}
        </Head>
    );
}
