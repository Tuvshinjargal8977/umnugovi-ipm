import { Head } from '@inertiajs/react';
import Container from '@/Components/Container';
import { ButtonLink } from '@/Components/Button';

const TEXT: Record<number, { title: string; body: string }> = {
    403: { title: 'Хандах эрхгүй', body: 'Танд энэ хуудсанд хандах эрх байхгүй байна.' },
    404: { title: 'Хуудас олдсонгүй', body: 'Таны хайсан хуудас байхгүй эсвэл шилжсэн байна.' },
    419: { title: 'Хугацаа дууссан', body: 'Сешн хугацаа дууссан тул хуудсаа дахин ачаална уу.' },
    429: { title: 'Хэт олон хүсэлт', body: 'Түр хүлээгээд дахин оролдоно уу.' },
    503: { title: 'Түр засварт байна', body: 'Сайт түр засварт байна. Удахгүй эргэн ирнэ үү.' },
};

export default function Error({ status }: { status: number }) {
    const t = TEXT[status] ?? { title: 'Алдаа гарлаа', body: 'Уучлаарай, ямар нэг зүйл буруу боллоо.' };
    return (
        <>
            <Head title={t.title} />
            <section className="bg-white">
                <Container className="flex min-h-[60vh] flex-col items-center justify-center gap-4 py-20 text-center">
                    <div className="text-[5rem] font-black leading-none text-brand-100">{status}</div>
                    <h1 className="text-2xl font-bold text-ink">{t.title}</h1>
                    <p className="max-w-md text-ink-soft">{t.body}</p>
                    <div className="mt-2 flex flex-wrap justify-center gap-3">
                        <ButtonLink href="/" variant="primary">
                            <i className="bi bi-house" /> Нүүр хуудас
                        </ButtonLink>
                        <ButtonLink href="/projects" variant="ghost">
                            Төслүүд
                        </ButtonLink>
                    </div>
                </Container>
            </section>
        </>
    );
}
