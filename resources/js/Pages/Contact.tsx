import { Head, useForm, usePage } from '@inertiajs/react';
import type { SharedProps } from '@/types';
import Container from '@/Components/Container';
import PageHero from '@/Components/PageHero';
import SectionHeading from '@/Components/SectionHeading';
import { Button } from '@/Components/Button';

const field = 'w-full rounded-md border border-black/25 px-3 py-2 text-[0.8rem] outline-none focus:border-brand-400';
const label = 'mb-1 block text-[0.72rem] font-semibold text-ink';

export default function Contact() {
    const { site, flash } = usePage<SharedProps>().props;
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        phone: '',
        subject: '',
        body: '',
    });

    const submit = (e: React.FormEvent) => {
        e.preventDefault();
        post('/contact-us', { preserveScroll: true, onSuccess: () => reset() });
    };

    const cards = [
        { icon: 'geo-alt-fill', label: 'Хаяг', value: site.address },
        { icon: 'telephone-fill', label: 'Утас', value: site.phone },
        { icon: 'envelope-fill', label: 'Имэйл', value: site.email },
    ];

    return (
        <>
            <Head title="Холбоо барих" />
            <PageHero title="Холбоо барих" crumbs={[{ label: 'Нүүр', href: '/' }, { label: 'Холбоо барих' }]} />

            <section className="bg-white">
                <Container className="py-12">
                    <div className="grid gap-8 lg:grid-cols-[22rem_1fr]">
                        <div className="flex flex-col gap-3">
                            {cards.map((c) => (
                                <div key={c.icon} className="flex items-start gap-3 rounded-card border border-black/10 p-6">
                                    <span className="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-brand-600">
                                        <i className={`bi bi-${c.icon}`} />
                                    </span>
                                    <div>
                                        <div className="font-bold text-ink">{c.label}</div>
                                        <div className="text-[0.8rem] text-ink-soft">{c.value}</div>
                                    </div>
                                </div>
                            ))}
                            <iframe src={site.mapEmbed} loading="lazy" className="aspect-[16/10] w-full rounded-lg border-0" />
                        </div>

                        <div>
                            <SectionHeading>Санал хүсэлт илгээх</SectionHeading>

                            {flash.success && (
                                <div className="mb-4 rounded-md bg-green-50 px-4 py-3 text-[0.8rem] text-green-800">
                                    {flash.success}
                                </div>
                            )}
                            {Object.keys(errors).length > 0 && (
                                <div className="mb-4 rounded-md bg-red-50 px-4 py-3 text-[0.8rem] text-red-700">
                                    <ul className="list-disc pl-4">
                                        {Object.values(errors).map((e, i) => (
                                            <li key={i}>{e as string}</li>
                                        ))}
                                    </ul>
                                </div>
                            )}

                            <form onSubmit={submit} className="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label className={label} htmlFor="c-name">
                                        Нэр <span className="text-red-500">*</span>
                                    </label>
                                    <input
                                        id="c-name"
                                        className={field}
                                        value={data.name}
                                        onChange={(e) => setData('name', e.target.value)}
                                        required
                                    />
                                </div>
                                <div>
                                    <label className={label} htmlFor="c-email">
                                        Имэйл
                                    </label>
                                    <input
                                        id="c-email"
                                        type="email"
                                        className={field}
                                        value={data.email}
                                        onChange={(e) => setData('email', e.target.value)}
                                    />
                                </div>
                                <div>
                                    <label className={label} htmlFor="c-phone">
                                        Утас
                                    </label>
                                    <input
                                        id="c-phone"
                                        className={field}
                                        value={data.phone}
                                        onChange={(e) => setData('phone', e.target.value)}
                                    />
                                </div>
                                <div>
                                    <label className={label} htmlFor="c-subject">
                                        Гарчиг
                                    </label>
                                    <input
                                        id="c-subject"
                                        className={field}
                                        value={data.subject}
                                        onChange={(e) => setData('subject', e.target.value)}
                                    />
                                </div>
                                <div className="sm:col-span-2">
                                    <label className={label} htmlFor="c-body">
                                        Агуулга <span className="text-red-500">*</span>
                                    </label>
                                    <textarea
                                        id="c-body"
                                        rows={5}
                                        className={field}
                                        value={data.body}
                                        onChange={(e) => setData('body', e.target.value)}
                                        required
                                    />
                                </div>
                                <div className="sm:col-span-2">
                                    <Button type="submit" disabled={processing}>
                                        Илгээх <i className="bi bi-send-fill" />
                                    </Button>
                                </div>
                            </form>
                        </div>
                    </div>
                </Container>
            </section>
        </>
    );
}
