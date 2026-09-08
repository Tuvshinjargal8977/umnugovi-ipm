import { Head } from '@inertiajs/react';
import type { Project, ProjectCard as ProjectT } from '@/types';
import Container from '@/Components/Container';
import PageHero from '@/Components/PageHero';
import SectionHeading from '@/Components/SectionHeading';
import ProjectCard from '@/Components/ProjectCard';
import { ButtonLink } from '@/Components/Button';

const FALLBACK = 'https://cdn.greensoft.mn/uploads/site/1698/product/new_eb642aeba0251318c889b0816673e9dc91b811c1.jpg';

function Fact({ k, v }: { k: string; v: string | null }) {
    if (!v) return null;
    return (
        <li className="flex gap-3 border-b border-dashed border-black/15 py-2.5 text-[0.78rem] last:border-0">
            <span className="min-w-40 font-bold text-ink">{k}</span>
            <span className="text-ink-soft">{v}</span>
        </li>
    );
}

export default function Show({ project, related }: { project: Project; related: ProjectT[] }) {
    return (
        <>
            <Head title={project.title} />
            <PageHero
                title={project.title}
                image={project.cover}
                crumbs={[
                    { label: 'Нүүр', href: '/' },
                    { label: 'Төслүүд', href: '/projects' },
                    { label: project.title.length > 40 ? project.title.slice(0, 40) + '…' : project.title },
                ]}
            />

            {/* summary */}
            <section className="bg-white">
                <Container className="py-12">
                    <div className="grid items-start gap-8 lg:grid-cols-2">
                        <figure className="m-0 aspect-square overflow-hidden rounded-card border border-black/10 bg-white">
                            <img src={project.cover || FALLBACK} alt="" className="h-full w-full object-cover" />
                        </figure>
                        <div className="flex flex-col gap-6">
                            <h2 className="text-[1.5rem] font-bold leading-tight text-ink md:text-[1.7rem]">{project.title}</h2>
                            <ul className="m-0 list-none p-0">
                                <Fact k="Явц:" v={project.status_label} />
                                <Fact k="Төсөл санаачлагч:" v={project.proponent} />
                                <Fact k="Төслийн явц:" v={project.phase} />
                                <Fact k="Судлагдсан байдал:" v={project.study_status} />
                                <Fact k="Гэрээний төрөл:" v={project.contract_type} />
                                <Fact k="Гэрээний хугацаа:" v={project.contract_duration} />
                                <Fact k="Урьдчилсан үнэлгээ:" v={project.preliminary_assessment_at} />
                                <Fact k="Мэдээллийн уулзалт:" v={project.info_meeting_at} />
                                <Fact k="Санал авах хугацаа:" v={project.proposal_deadline} />
                            </ul>
                            <div className="flex flex-wrap gap-2">
                                <ButtonLink href="#detail" variant="primary">
                                    Дэлгэрэнгүй <i className="bi bi-arrow-right-circle-fill" />
                                </ButtonLink>
                                <ButtonLink href="/contact-us" variant="ghost">
                                    <i className="bi bi-file-earmark-medical-fill" /> Санал илгээх
                                </ButtonLink>
                            </div>
                        </div>
                    </div>
                </Container>
            </section>

            {/* detail */}
            {(project.body || project.policy_reference || project.financing) && (
                <section id="detail" className="border-t border-black/5 bg-white">
                    <Container className="flex flex-col gap-4 py-12">
                        <SectionHeading>Төслийн дэлгэрэнгүй мэдээлэл</SectionHeading>
                        {project.summary && <p className="text-[0.9rem] leading-relaxed text-ink">{project.summary}</p>}
                        <hr className="my-1 border-black/10" />
                        <div className="grid items-start gap-8 md:grid-cols-2">
                            <img
                                src={project.detail_image || 'https://cdn.greensoft.mn/uploads/users/45/images/PPPC%20Gov/1.jpg'}
                                alt=""
                                className="w-full rounded-lg border border-black/10"
                            />
                            <div className="prose-cms">
                                {project.body && <div dangerouslySetInnerHTML={{ __html: project.body }} />}
                                {project.policy_reference && (
                                    <>
                                        <p>
                                            <strong>Хөгжлийн бодлогын баримт бичигт тусгагдсан эсэх:</strong>
                                        </p>
                                        <div dangerouslySetInnerHTML={{ __html: project.policy_reference }} />
                                    </>
                                )}
                                {project.financing && (
                                    <>
                                        <p>
                                            <strong>Санхүүжилтийн хэлбэр:</strong>
                                        </p>
                                        <div dangerouslySetInnerHTML={{ __html: project.financing }} />
                                    </>
                                )}
                                {project.address && (
                                    <p className="text-justify">
                                        <strong>Хаяг:</strong> {project.address}
                                    </p>
                                )}
                            </div>
                        </div>
                    </Container>
                </section>
            )}

            {/* related */}
            {related.length > 0 && (
                <section className="border-t border-black/5 bg-slate-50">
                    <Container className="py-12">
                        <SectionHeading size="sm">Холбоотой төслүүд</SectionHeading>
                        <div className="grid gap-5 md:grid-cols-3">
                            {related.map((p) => (
                                <ProjectCard key={p.slug} project={p} />
                            ))}
                        </div>
                    </Container>
                </section>
            )}
        </>
    );
}
