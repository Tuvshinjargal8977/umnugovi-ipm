import { Link } from '@inertiajs/react';
import type { Post, PostCard as PostT, PostCategory } from '@/types';
import Container from '@/Components/Container';
import Seo from '@/Components/Seo';
import PostSidebar from '@/Components/PostSidebar';
import { ButtonLink } from '@/Components/Button';

export default function Show({
    post,
    recent,
    categories,
}: {
    post: Post & { published_at_full: string | null };
    recent: PostT[];
    categories: PostCategory[];
}) {
    const shareUrl = typeof window !== 'undefined' ? encodeURIComponent(window.location.href) : '';

    return (
        <>
            <Seo
                title={post.title}
                description={post.excerpt || undefined}
                image={post.cover}
                type="article"
            />

            <section className="relative isolate overflow-hidden bg-brand-900">
                {post.cover && <img src={post.cover} alt="" className="absolute inset-0 -z-10 h-full w-full object-cover" />}
                <div className="absolute inset-0 -z-10 bg-gradient-to-r from-brand-900/90 to-brand-500/70" />
                <Container className="flex flex-col gap-3 py-12 lg:py-16">
                    <nav
                        aria-label="breadcrumb"
                        className="flex flex-wrap items-center gap-2 text-[0.6rem] font-bold uppercase tracking-wide text-white/90"
                    >
                        <Link href="/">Нүүр</Link>
                        <span className="text-white/50">/</span>
                        <Link href="/posts">Мэдээ мэдээлэл</Link>
                        {post.category && (
                            <>
                                <span className="text-white/50">/</span>
                                <Link href={`/posts?category=${post.category.slug}`}>{post.category.name}</Link>
                            </>
                        )}
                    </nav>
                    <h1 className="max-w-4xl text-2xl font-bold leading-snug text-white md:text-[1.7rem]">{post.title}</h1>
                    <div className="flex flex-wrap gap-4 text-[0.75rem] text-white/85">
                        <span>
                            <i className="bi bi-calendar3 mr-1" />
                            {post.published_at_full}
                        </span>
                        {post.author && (
                            <span>
                                <i className="bi bi-person mr-1" />
                                {post.author}
                            </span>
                        )}
                    </div>
                </Container>
            </section>

            <section className="bg-surface">
                <Container className="py-12">
                    <div className="grid gap-10 lg:grid-cols-[1fr_18rem]">
                        <div>
                            <div className="prose-cms">
                                {post.excerpt && <p className="text-[1rem] font-medium text-ink">{post.excerpt}</p>}
                                {post.body && <div dangerouslySetInnerHTML={{ __html: post.body }} />}
                            </div>

                            <hr className="my-6 border-line" />
                            <div className="flex flex-wrap items-center gap-3">
                                <ButtonLink href="/posts" variant="ghost">
                                    <i className="bi bi-arrow-left" /> Жагсаалт руу
                                </ButtonLink>
                                <div className="ml-auto flex gap-2">
                                    {[
                                        { i: 'facebook', label: 'Facebook-т хуваалцах', u: `https://www.facebook.com/sharer/sharer.php?u=${shareUrl}` },
                                        { i: 'twitter-x', label: 'X-д хуваалцах', u: `https://twitter.com/intent/tweet?url=${shareUrl}` },
                                        { i: 'envelope', label: 'Имэйлээр илгээх', u: `mailto:?body=${shareUrl}` },
                                    ].map((s) => (
                                        <a
                                            key={s.i}
                                            href={s.u}
                                            target="_blank"
                                            rel="noopener"
                                            aria-label={s.label}
                                            className="flex h-9 w-9 items-center justify-center rounded-full border border-line text-ink-soft hover:border-brand-500 hover:bg-brand-500 hover:text-white"
                                        >
                                            <i className={`bi bi-${s.i}`} />
                                        </a>
                                    ))}
                                </div>
                            </div>
                        </div>

                        <div className="flex flex-col gap-8">
                            <PostSidebar categories={categories} active={post.category?.slug} />
                            <div>
                                <div className="mb-3 flex items-center gap-3">
                                    <h2 className="m-0 text-base font-bold uppercase text-ink">Сүүлийн мэдээ</h2>
                                    <span className="h-px flex-1 bg-line" />
                                </div>
                                <ul className="flex flex-col gap-3">
                                    {recent.map((r) => (
                                        <li key={r.slug}>
                                            <Link href={`/posts/${r.slug}`} className="flex flex-col">
                                                <span className="text-[0.7rem] text-ink-soft">{r.published_at}</span>
                                                <span className="font-semibold leading-snug text-ink hover:text-link">
                                                    {r.title}
                                                </span>
                                            </Link>
                                        </li>
                                    ))}
                                </ul>
                            </div>
                        </div>
                    </div>
                </Container>
            </section>
        </>
    );
}
