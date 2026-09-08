import Container from './Container';
import SectionHeading from './SectionHeading';

const STAGES = [
    { t: 'Төсөл санаачлах', d: 'Салбар яам болон хувийн хэвшлээс санаачилна' },
    { t: 'Урьдчилсан үнэлгээ хийх', d: 'Төслийн боломж, эрсдэлийг урьдчилан үнэлнэ' },
    { t: 'Бүрэн шинжилгээ', d: 'Бүрэн шинжилгээгээр төслийг тодорхойлж дүгнэнэ' },
    { t: 'Түншлэгч сонгох', d: 'Хувийн хэвшлийн түншлэгч болон зөвлөх үйлчилгээг сонгон шалгаруулна' },
    { t: 'Гэрээ байгуулах', d: 'Түншлэлийн гэрээ байгуулна' },
    { t: 'Хэрэгжилт, хяналт', d: 'Төслийн хэрэгжилт, санхүүжилт, зохион байгуулалт, тайлагнал, хяналт' },
];

export default function ProjectStages() {
    return (
        <section className="bg-surface-sunken">
            <Container className="py-12">
                <SectionHeading size="sm">Түншлэлийн төслийн үе шат</SectionHeading>
                <p className="mb-6 text-[0.8rem] text-ink-soft">Төр, хувийн хэвшлийн түншлэлийн тухай хуулийн 17 дугаар зүйлийн дагуу</p>

                <ol className="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
                    {STAGES.map((s, i) => (
                        <li
                            key={i}
                            className="relative flex flex-col gap-2 rounded-card border border-line bg-surface p-4"
                        >
                            <span className="flex h-8 w-8 items-center justify-center rounded-full bg-brand-500 text-[0.8rem] font-bold text-white">
                                {i + 1}
                            </span>
                            {/* progress bar */}
                            <span className="flex gap-0.5">
                                {Array.from({ length: 6 }).map((_, k) => (
                                    <span
                                        key={k}
                                        className={`h-1 flex-1 rounded-full ${k <= i ? 'bg-accent' : 'bg-line'}`}
                                    />
                                ))}
                            </span>
                            <span className="font-bold leading-snug text-ink">{s.t}</span>
                            <span className="text-[0.72rem] leading-snug text-ink-soft">{s.d}</span>
                        </li>
                    ))}
                </ol>
            </Container>
        </section>
    );
}
