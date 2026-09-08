import { useEffect, useState } from 'react';

/**
 * Гэрэлтэй / харанхуй горим сэлгэгч.
 * Сонголтыг localStorage-д хадгална; эхний утгыг app.blade.php доторх
 * script тавьсан `.dark` класс дээр үндэслэнэ.
 */
export default function ThemeToggle({ className = '' }: { className?: string }) {
    const [dark, setDark] = useState(false);

    useEffect(() => {
        setDark(document.documentElement.classList.contains('dark'));
    }, []);

    const toggle = () => {
        const next = !document.documentElement.classList.contains('dark');
        document.documentElement.classList.toggle('dark', next);
        try {
            localStorage.setItem('theme', next ? 'dark' : 'light');
        } catch (e) {
            /* localStorage боломжгүй — зүгээр л үл тоомсорлоно */
        }
        setDark(next);
    };

    const label = dark ? 'Гэрэлтэй горимд шилжих' : 'Харанхуй горимд шилжих';

    return (
        <button
            type="button"
            onClick={toggle}
            aria-label={label}
            title={label}
            className={`flex h-8 w-8 items-center justify-center rounded-full border border-brand-200 text-[0.8rem] text-brand-600 transition-colors hover:border-brand-500 hover:bg-brand-500 hover:text-white dark:border-white/20 dark:text-white/85 dark:hover:border-accent dark:hover:bg-accent dark:hover:text-brand-950 ${className}`}
        >
            <i className={`bi ${dark ? 'bi-sun-fill' : 'bi-moon-stars-fill'}`} aria-hidden="true" />
        </button>
    );
}
