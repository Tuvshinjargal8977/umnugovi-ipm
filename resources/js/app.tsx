import '../css/app.css';

import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createRoot } from 'react-dom/client';
import SiteLayout from '@/Layouts/SiteLayout';
import type { ReactElement } from 'react';

createInertiaApp({
    title: (title) => (title ? `${title} — Өмнөговь аймгийн төслийн удирдлагын газар` : 'Өмнөговь аймгийн төслийн удирдлагын газар'),
    resolve: async (name) => {
        const page: any = await resolvePageComponent(
            `./Pages/${name}.tsx`,
            import.meta.glob('./Pages/**/*.tsx'),
        );
        page.default.layout ??= (p: ReactElement) => <SiteLayout>{p}</SiteLayout>;
        return page;
    },
    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />);
    },
    progress: {
        color: '#2c6dd1',
        showSpinner: false,
    },
});
