import type { ReactNode } from 'react';
import { usePage } from '@inertiajs/react';
import type { SharedProps } from '@/types';
import Header from '@/Components/Header';
import Footer from '@/Components/Footer';

export default function SiteLayout({ children }: { children: ReactNode }) {
    const { site } = usePage<SharedProps>().props;

    return (
        <div className="flex min-h-screen flex-col bg-surface">
            <a href="#main" className="skip-link">
                Контент руу шилжих
            </a>
            <Header />
            <main id="main" className="flex-1">
                {children}
            </main>
            <Footer />

            <a
                href={'tel:' + site.phone.replace(/[^0-9+]/g, '')}
                aria-label="Залгах"
                className="fixed bottom-5 right-5 z-40 flex h-12 w-12 items-center justify-center rounded-full bg-brand-600 text-white shadow-[0_0.75rem_1.75rem_-0.25rem_rgba(20,49,90,0.45)] transition-all hover:scale-110 hover:bg-accent"
            >
                <i className="bi bi-telephone-fill" />
            </a>
        </div>
    );
}
