import { Link } from '@inertiajs/react';
import type { PostCategory } from '@/types';

export default function PostSidebar({
    categories,
    active,
}: {
    categories: PostCategory[];
    active?: string | null;
}) {
    return (
        <div>
            <div className="mb-3 flex items-center gap-3">
                <h2 className="m-0 text-lg font-bold uppercase text-ink">Ангилал</h2>
                <span className="h-px flex-1 bg-line" />
            </div>
            <ul className="flex flex-col gap-1">
                <li>
                    <Link
                        href="/posts"
                        className={`block rounded-lg px-3 py-2 text-[0.8rem] transition-colors ${
                            !active ? 'bg-brand-500 font-bold text-white' : 'text-ink-soft hover:bg-brand-tint hover:text-link'
                        }`}
                    >
                        Бүх мэдээ
                    </Link>
                </li>
                {categories.map((c) => (
                    <li key={c.slug}>
                        <Link
                            href={`/posts?category=${c.slug}`}
                            className={`flex items-center justify-between rounded-lg px-3 py-2 text-[0.8rem] transition-colors ${
                                active === c.slug
                                    ? 'bg-brand-500 font-bold text-white'
                                    : 'text-ink-soft hover:bg-brand-tint hover:text-link'
                            }`}
                        >
                            <span>{c.name}</span>
                            <span className="text-[0.7rem] opacity-70">{c.posts_count}</span>
                        </Link>
                    </li>
                ))}
            </ul>
        </div>
    );
}
