export interface CatVisual {
    icon: string;
    from: string;
    to: string;
}

const MAP: Record<string, CatVisual> = {
    'erchim-khuch': { icon: 'bi-lightning-charge-fill', from: '#f0b429', to: '#de911d' },
    'deed-baiguulamj': { icon: 'bi-signpost-split-fill', from: '#2b60ab', to: '#183a6a' },
    'khudaldaa-uilchilgee': { icon: 'bi-shop', from: '#e05252', to: '#b83a3a' },
    'barilga-oron-suuts': { icon: 'bi-buildings-fill', from: '#5b8def', to: '#3667c9' },
    'azh-uildver': { icon: 'bi-gear-wide-connected', from: '#7c8794', to: '#5a6474' },
    'khodoo-azh-akhui': { icon: 'bi-tree-fill', from: '#4caf6b', to: '#357a4c' },
    'niitiin-uilchilgee': { icon: 'bi-recycle', from: '#3aa0a0', to: '#2b7a7a' },
    'ayalal-julchlal': { icon: 'bi-compass-fill', from: '#9b6bd6', to: '#7548b0' },
    'nisekh-buudal': { icon: 'bi-airplane-fill', from: '#2b60ab', to: '#183a6a' },
};

const FALLBACK: CatVisual = { icon: 'bi-diagram-3-fill', from: '#2b60ab', to: '#183a6a' };

export function catVisual(slug?: string | null): CatVisual {
    return (slug && MAP[slug]) || FALLBACK;
}
