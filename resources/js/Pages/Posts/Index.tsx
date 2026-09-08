import { Link } from '@inertiajs/react';
import type { Paginated, PostCard as PostT, PostCategory } from '@/types';
import Container from '@/Components/Container';
import Seo from '@/Components/Seo';
import PageHero from '@/Components/PageHero';
import PostSidebar from '@/Components/PostSidebar';
import Pagination from '@/Components/Pagination';

const FALLBACK = '/images/placeholder.svg';

export default function Index({
    posts,
    categories,
    active,
}: {
    posts: Paginated<PostT>;
    categories: PostCategory[];
    active: string | null;
}) {
    const activeCat = categories.find((c) => c.slug === active);
    const title = activeCat ? activeCat.name : 'Мэдээ мэдээлэл';

    return (
        <>
            <Seo
                title={title}
                description={`Өмнөговь аймгийн Төслийн удирдлагын газрын ${title.toLowerCase()} — мэдээ, зарлал, арга хэмжээ, сонгон шалгаруулалт.`}
            />
            <PageHero
                title={title}
                crumbs={[
                    { label: 'Нүүр', href: '/' },
                    { label: 'Мэдээ мэдээлэл', href: '/posts' },
                    ...(activeCat ? [{ label: activeCat.name }] : []),
                ]}
            />

            <section className="bg-surface">
                <Container className="py-12">
                    <div className="grid gap-8 lg:grid-cols-[16rem_1fr]">
                        <aside className="order-2 lg:order-1">
                            <PostSidebar categories={categories} active={active} />
                        </aside>

                        <div className="order-1 lg:order-2">
                            {posts.data.length === 0 ? (
                                <p className="text-ink-soft">Энэ ангилалд нийтэлсэн мэдээ алга.</p>
                            ) : (
                                <>
                                    <div className="flex flex-col divide-y divide-line">
                                        {posts.data.map((p) => (
                                            <article key={p.slug} className="flex flex-col gap-4 py-6 first:pt-0 sm:flex-row">
                                                <Link href={`/posts/${p.slug}`} className="shrink-0">
                                                    <img
                                                        src={p.cover || FALLBACK}
                                                        alt={p.cover ? p.title : ''}
                                                        loading="lazy"
                                                        className="aspect-[16/10] w-full rounded-lg object-cover sm:w-56"
                                                    />
                                                </Link>
                                                <div>
                                                    <div className="flex flex-wrap gap-3 text-[0.7rem] text-ink-faint">
                                                        <span>
                                                            <i className="bi bi-calendar3 mr-1" />
                                                            {p.published_at}
                                                        </span>
                                                        {p.author && (
                                                            <span>
                                                                <i className="bi bi-person mr-1" />
                                                                {p.author}
                                                            </span>
                                                        )}
                                                        {p.category && (
                                                            <Link
                                                                href={`/posts?category=${p.category.slug}`}
                                                                className="rounded bg-surface-sunken px-1.5 text-ink-soft"
                                                            >
                                                                {p.category.name}
                                                            </Link>
                                                        )}
                                                    </div>
                                                    <h3 className="my-1.5 text-base font-bold leading-snug">
                                                        <Link href={`/posts/${p.slug}`} className="text-ink hover:text-link">
                                                            {p.title}
                                                        </Link>
                                                    </h3>
                                                    {p.excerpt && (
                                                        <p className="text-[0.78rem] text-ink-soft line-clamp-2">{p.excerpt}</p>
                                                    )}
                                                </div>
                                            </article>
                                        ))}
                                    </div>
                                    <Pagination links={posts.links} />
                                </>
                            )}
                        </div>
                    </div>
                </Container>
            </section>
        </>
    );
}
