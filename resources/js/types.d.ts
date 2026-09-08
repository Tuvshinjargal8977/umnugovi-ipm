import type { PageProps as InertiaPageProps } from '@inertiajs/core';

export interface NavChild {
    label: string;
    url: string;
}
export interface NavItem {
    label: string;
    url?: string;
    children?: NavChild[];
}

export interface SharedProps extends InertiaPageProps {
    site: {
        name: string;
        nameShort: string;
        emblem: string;
        logo: string;
        phone: string;
        email: string;
        address: string;
        facebook: string | null;
        mapEmbed: string;
        heroImage: string;
    };
    nav: NavItem[];
    locale: string;
    locales: string[];
    flash: { success?: string | null };
}

export interface Paginated<T> {
    data: T[];
    links: { url: string | null; label: string; active: boolean }[];
    meta?: { current_page: number; last_page: number; total: number };
}

export interface ProjectCard {
    slug: string;
    title: string;
    status?: string;
    status_label: string;
    cover: string | null;
    proposal_deadline: string | null;
    category?: { name: string; slug: string } | null;
}

export interface Project extends ProjectCard {
    summary: string | null;
    body: string | null;
    proponent: string | null;
    phase: string | null;
    study_status: string | null;
    contract_type: string | null;
    contract_duration: string | null;
    financing: string | null;
    policy_reference: string | null;
    address: string | null;
    preliminary_assessment_at: string | null;
    info_meeting_at: string | null;
    detail_image: string | null;
}

export interface PostCard {
    slug: string;
    title: string;
    excerpt: string | null;
    cover: string | null;
    published_at: string | null;
    author: string | null;
    category: { name: string; slug: string } | null;
}

export interface Post extends PostCard {
    body: string | null;
}

export interface PostCategory {
    name: string;
    slug: string;
    posts_count: number;
}
