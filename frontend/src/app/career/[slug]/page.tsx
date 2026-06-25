"use client"
import { useState, useEffect, use } from "react"
import Image from "next/image"
import { Icon } from "@iconify/react"
import { Loader2 } from "lucide-react"

interface Job {
  id: number;
  title: string;
  job_category_id: number;
  slug: string;
  job_category?: { id: number, name: string };
  location: string;
  employment_type: string;
  description: string;
  qualification: string;
  skills?: string[];
  deadline: string;
  status: string;
  created_at: string;
  updated_at: string;
}

export default function CareerDetailPage({ params }: { params: Promise<{ slug: string }> }) {
  const resolvedParams = use(params);
  const slug = resolvedParams.slug;

  const [job, setJob] = useState<Job | null>(null)
  const [latestJobs, setLatestJobs] = useState<Job[]>([])
  const [isLoading, setIsLoading] = useState(true)

  useEffect(() => {
    const fetchJobData = async () => {
      try {
        const apiUrl = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api';

        // Fetch current job
        const jobRes = await fetch(`${apiUrl}/lowongan/${slug}`);
        if (!jobRes.ok) throw new Error("Job not found");

        let jobResult;
        if (jobRes.headers.get("content-type")?.includes("application/json")) {
          jobResult = await jobRes.json();
        } else {
          throw new Error("Job response is not JSON");
        }
        setJob(jobResult.data);

        // Fetch latest jobs
        const allJobsRes = await fetch(`${apiUrl}/lowongan`);
        if (allJobsRes.ok && allJobsRes.headers.get("content-type")?.includes("application/json")) {
          const allJobsResult = await allJobsRes.json();
          setLatestJobs(allJobsResult.data || []);
        }
      } catch (error) {
        console.error("Failed to fetch job data:", error);
      } finally {
        setIsLoading(false);
      }
    };

    fetchJobData();
  }, [slug]);

  if (isLoading) {
    return (
      <div className="w-full min-h-screen flex items-center justify-center bg-white pt-20">
        <Loader2 className="w-10 h-10 animate-spin text-[#003B65]" />
      </div>
    );
  }

  if (!job) {
    return (
      <div className="w-full min-h-screen flex items-center justify-center bg-white pt-20">
        <div className="text-center space-y-4">
          <h1 className="text-3xl font-bold text-gray-800">Job Not Found</h1>
          <p className="text-gray-500">The position you are looking for might have been closed or doesn't exist.</p>
          <a href="/career" className="inline-block px-6 py-2 bg-[#003B65] text-white rounded-md">Back to Careers</a>
        </div>
      </div>
    );
  }

  return (
    <div className="w-full bg-white pt-20">

      <div className="relative h-[200px] md:h-[300px]">
        <Image
          src="/images/background-career-detail.jpg"
          alt="background career detail"
          fill
          className="object-cover"
        />
      </div>

      <div className="absolute bg-white left-20 top-85 rounded-lg h-[70px] w-[70px] overflow-hidden shadow">
        <Image
          src="/images/logo.png"
          alt="logo pt silga perkasa"
          fill
          className="object-cover"
        />
      </div>

      <div className="bg-[#FAFAFA] w-full">
        <div className="px-8 md:px-14 lg:px-20 py-12 md:py-16 space-y-4">

          <div className="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h1 className="font-semibold text-3xl">{job.title}</h1>

            <div className="flex items-center">
              <button className="px-5 h-10 bg-[#003B65] text-white rounded text-[12px] cursor-pointer hover:bg-blue-900 transition-colors">Apply Now</button>
            </div>
          </div>

          <div className="flex flex-row items-center space-x-4 mt-3 border-b border-gray-300 pb-4 flex-wrap gap-y-2">
            <div className="flex flex-row items-center gap-2">
              <Icon
                icon="famicons:location-outline"
                className="text-gray-500 w-5 h-5"
              />
              <span className="text-gray-500 text-[12px]">{job.location}</span>
            </div>

            <div className="flex flex-row items-center gap-2">
              <Icon
                icon="mdi:clock-outline"
                className="text-gray-500 w-5 h-5"
              />
              <span className="text-[12px] text-gray-500 capitalize">{job.employment_type?.replace('_', ' ')}</span>
            </div>

            <div className="flex flex-row items-center gap-2">
              <Icon
                icon="uil:suitcase-alt"
                className="text-gray-500 w-5 h-5"
              />
              <span className="text-gray-500 text-[12px]">{job.job_category?.name}</span>
            </div>

            <div className="flex flex-row items-center gap-2">
              <Icon
                icon="mdi:calendar-outline"
                className="text-gray-500 w-5 h-5"
              />
              <span className="text-gray-500 text-[12px]">Deadline: {new Date(job.deadline).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}</span>
            </div>
          </div>

          <div className="grid grid-cols-1 lg:grid-cols-3 gap-6 pt-4">
            <div className="bg-white lg:col-span-2 rounded-lg p-6 space-y-8 shadow">
              <div className="flex flex-col gap-3">
                <h3 className="font-semibold text-xl border-b pb-2 border-gray-200">About Job</h3>
                <div className="text-[13px] text-gray-700 whitespace-pre-wrap leading-relaxed [&>ul]:list-disc [&>ul]:pl-5 [&>ol]:list-decimal [&>ol]:pl-5" dangerouslySetInnerHTML={{ __html: job.description }}>
                </div>
              </div>

              <div className="flex flex-col gap-3">
                <h3 className="font-semibold text-xl border-b border-gray-200 pb-2">Requirements / Qualifications</h3>
                <div className="text-[13px] text-gray-700 whitespace-pre-wrap leading-relaxed [&>ul]:list-disc [&>ul]:pl-5 [&>ol]:list-decimal [&>ol]:pl-5" dangerouslySetInnerHTML={{ __html: job.qualification }}>
                </div>
              </div>

              {job.skills && job.skills.length > 0 && (
                <div className="flex flex-col gap-3">
                  <h3 className="font-semibold text-xl border-b border-gray-200 pb-2">Required Skills</h3>
                  <div className="flex flex-wrap gap-2 pt-1">
                    {job.skills.map((skill, index) => (
                      <span key={index} className="px-3 py-1.5 bg-blue-50 text-blue-700 border border-blue-100 text-xs font-medium rounded-full">
                        {skill}
                      </span>
                    ))}
                  </div>
                </div>
              )}
            </div>

            <div className="bg-white rounded-lg shadow p-6 space-y-4 lg:sticky lg:top-24 h-fit">
              <div className="flex items-center justify-between border-b pb-3 border-gray-200">
                <h3 className="font-semibold text-lg">Other Opportunities</h3>
                <span className="text-xs text-gray-400 bg-gray-100 px-2 py-1 rounded">{latestJobs.filter(j => j.id !== job.id).length} positions</span>
              </div>

              <div className="flex flex-col gap-3 overflow-y-auto max-h-[450px] pr-2 
                [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-track]:bg-transparent 
                [&::-webkit-scrollbar-thumb]:bg-gray-200 [&::-webkit-scrollbar-thumb]:rounded-full 
                hover:[&::-webkit-scrollbar-thumb]:bg-gray-300">
                {latestJobs
                  .filter(j => j.id !== job.id)
                  .slice(0, 5)
                  .map((item) => (
                    <a
                      key={item.id}
                      href={`/career/${item.slug}`}
                      className="flex flex-col w-full bg-transparent hover:bg-gray-50 border border-transparent hover:border-gray-200 gap-2 rounded-lg p-3 transition-all duration-200 group"
                    >
                      <span className="font-semibold text-sm group-hover:text-[#003B65] transition-colors">{item.title}</span>
                      <div className="text-xs text-gray-500 line-clamp-2" dangerouslySetInnerHTML={{ __html: item.description }}></div>

                      <div className="flex flex-row gap-3 mt-1 flex-wrap">
                        <div className="flex flex-row items-center gap-1.5">
                          <Icon icon="famicons:location-outline" className="text-gray-400 w-3 h-3" />
                          <span className="text-[11px] text-gray-400">{item.location}</span>
                        </div>
                        <div className="flex flex-row items-center gap-1.5">
                          <Icon icon="mdi:clock-outline" className="text-gray-400 w-3 h-3" />
                          <span className="text-[11px] text-gray-400 capitalize">{item.employment_type?.replace('_', ' ')}</span>
                        </div>
                        <div className="flex flex-row items-center gap-1.5">
                          <Icon icon="uil:suitcase-alt" className="text-gray-400 w-3 h-3" />
                          <span className="text-[11px] text-gray-400">{item.job_category?.name}</span>
                        </div>
                      </div>
                    </a>
                  ))}
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  )
}
