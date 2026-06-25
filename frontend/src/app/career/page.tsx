"use client"
import { useState, useEffect, useMemo } from "react"
import Image from "next/image"
import Link from "next/link"
import { Search, MapPin, Briefcase, ChevronDown, Loader2 } from "lucide-react"
import { motion } from "framer-motion"
import Counter from "@/component/counter"

interface Job {
  id: number;
  title: string;
  slug: string;
  job_category_id: number;
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

export default function Career() {
  const [searchQuery, setSearchQuery] = useState("")
  const [location, setLocation] = useState("")
  const [category, setCategory] = useState("")
  const [jobs, setJobs] = useState<Job[]>([])
  const [isLoading, setIsLoading] = useState(true)

  const uniqueCategories = useMemo(() => {
    const categories = new Set<string>();
    jobs.forEach(job => {
      if (job.job_category?.name) {
        categories.add(job.job_category.name);
      }
    });
    return Array.from(categories);
  }, [jobs]);

  useEffect(() => {
    const fetchJobs = async () => {
      try {
        const res = await fetch(`${process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api'}/lowongan`);
        if (!res.ok) {
          throw new Error(`API error: ${res.status} ${res.statusText}`);
        }

        // Cek apakah response berupa JSON sebelum di parse
        const contentType = res.headers.get("content-type");
        if (contentType && contentType.indexOf("application/json") !== -1) {
          const result = await res.json();
          setJobs(result.data || []);
        } else {
          throw new Error("Oops, API did not return JSON. Is the backend running properly?");
        }
      } catch (error) {
        console.error("Failed to fetch jobs:", error);
      } finally {
        setIsLoading(false);
      }
    };
    fetchJobs();
  }, []);

  return (
    <div className="flex flex-col min-h-screen font-sans">
      {/* Hero Section with Search Bar */}
      <section className="relative w-full h-[80vh] md:h-[70vh] lg:h-[80vh]">
        {/* Background Image */}
        <div className="absolute inset-0">
          <Image
            src="/images/background-career.png"
            alt="background"
            fill
            className="object-cover object-top md:object-center"
          />
          <div className="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70" />
        </div>

        {/* Hero Content */}
        <div className="relative z-[5] flex flex-col items-center justify-center h-full px-5 pt-28 md:pt-20">
          <motion.h1
            initial={{ opacity: 0, y: 30 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8 }}
            className="text-4xl md:text-5xl lg:text-6xl font-medium text-white text-center mb-4 tracking-tight">
            Temukan Peluang Karier Anda
          </motion.h1>
          <motion.p
            initial={{ opacity: 0, y: 30 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8, delay: 0.2 }}
            className="text-sm md:text-md text-white/80 text-center mb-10 max-w-2xl">
            Jelajahi berbagai lowongan yang tersedia dan gunakan pencarian di bawah untuk menemukan posisi yang sesuai dengan keahlian, minat, atau lokasi yang Anda inginkan.
          </motion.p>

          {/* Search Bar */}
          <motion.div
            initial={{ opacity: 0, y: 30 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8, delay: 0.4 }}
            className="w-full max-w-5xl">
            <div className="bg-white rounded-xl shadow-2xl p-3 flex flex-col md:flex-row gap-3">
              {/* Job Search Input */}
              <div className="flex items-center gap-3 flex-1 px-4 py-3 bg-gray-50 rounded-xl border border-gray-100 hover:border-blue-200 transition-colors group">
                <Search className="w-5 h-5 text-gray-400 group-hover:text-[#003B65] transition-colors" />
                <input
                  type="text"
                  placeholder="Job title or keyword..."
                  value={searchQuery}
                  onChange={(e) => setSearchQuery(e.target.value)}
                  className="flex-1 bg-transparent outline-none text-gray-700 placeholder-gray-400 text-sm"
                />
              </div>

              {/* Location Input */}
              <div className="flex items-center gap-3 flex-1 px-4 py-3 bg-gray-50 rounded-xl border border-gray-100 hover:border-blue-200 transition-colors group">
                <MapPin className="w-5 h-5 text-gray-400 group-hover:text-[#003B65] transition-colors" />
                <input
                  type="text"
                  placeholder="Location..."
                  value={location}
                  onChange={(e) => setLocation(e.target.value)}
                  className="flex-1 bg-transparent outline-none text-gray-700 placeholder-gray-400 text-sm"
                />
              </div>

              {/* Category Select */}
              <div className="flex items-center gap-3 flex-1 px-4 py-3 bg-gray-50 rounded-xl border border-gray-100 hover:border-blue-200 transition-colors group relative">
                <Briefcase className="w-5 h-5 text-gray-400 group-hover:text-[#003B65] transition-colors" />
                <select
                  value={category}
                  onChange={(e) => setCategory(e.target.value)}
                  className="flex-1 bg-transparent outline-none text-gray-700 text-sm appearance-none cursor-pointer"
                >
                  <option value="">All Categories</option>
                  {uniqueCategories.map(cat => (
                    <option key={cat} value={cat}>{cat}</option>
                  ))}
                </select>
                <ChevronDown className="w-4 h-4 text-gray-400 absolute right-4 pointer-events-none" />
              </div>

              {/* Search Button */}
              <button className="px-8 py-3 bg-[#003B65] text-white font-semibold rounded-lg transition-all duration-300 shadow-md shadow-blue-500/25 hover:shadow-blue-500/40 hover:scale-[1.0] active:scale-[0.98] whitespace-nowrap cursor-pointer">
                Search Jobs
              </button>
            </div>
          </motion.div>
        </div>
      </section>

      {/* Stats Section */}
      <section className="bg-white border-b border-gray-100">
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.8 }}
          className="max-w-6xl mx-auto px-4 py-10 grid grid-cols-2 md:grid-cols-4 gap-6">

          <div className="text-center">
            <div className="text-4xl md:text-5xl font-bold text-[#003B65]">
              <Counter target={50} suffix="+" />
            </div>
            <p className="text-gray-500 mt-2 font-medium">Open Position</p>
          </div>
          <div className="text-center">
            <div className="text-4xl md:text-5xl font-bold text-[#003B65]">
              <Counter target={150} suffix="+" />
            </div>
            <p className="text-gray-500 mt-2 font-medium">Employee</p>
          </div>
          <div className="text-center">
            <div className="text-4xl md:text-5xl font-bold text-[#003B65]">
              <Counter target={5} suffix="+" />
            </div>
            <p className="text-gray-500 mt-2 font-medium">Location</p>
          </div>
          <div className="text-center">
            <div className="text-4xl md:text-5xl font-bold text-[#003B65]">
              <Counter target={25} suffix="+" />
            </div>
            <p className="text-gray-500 mt-2 font-medium">Year Experience</p>
          </div>
        </motion.div>
      </section>

      {/* Featured Jobs Preview */}
      <section className="bg-gray-50 flex-1">
        <div className="w-full mx-auto px-8 md:px-16 lg:px-24 py-10">
          <div className="text-center mb-12">
            <h2 className="text-3xl font-bold text-gray-900 mb-3">Featured Opportunities</h2>
            <p className="text-gray-500 max-w-xl mx-auto">Explore our latest openings and find the perfect role for you</p>
          </div>

          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
            {isLoading ? (
              <div className="col-span-full flex justify-center py-10 text-[#003B65]">
                <Loader2 className="w-8 h-8 animate-spin" />
              </div>
            ) : jobs.length > 0 ? (
              jobs.filter(job => {
                const matchQuery = job.title.toLowerCase().includes(searchQuery.toLowerCase()) || (job.description && job.description.toLowerCase().includes(searchQuery.toLowerCase()));
                const matchLocation = location === "" || (job.location && job.location.toLowerCase().includes(location.toLowerCase()));
                const matchCategory = category === "" || (job.job_category?.name && job.job_category.name.toLowerCase().includes(category.toLowerCase()));
                return matchQuery && matchLocation && matchCategory;
              }).map((job, i) => (
                <motion.div
                  initial={{ opacity: 0, y: 30 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  viewport={{ once: true }}
                  transition={{ duration: 0.6, delay: i * 0.1 }}
                  key={job.id}
                  className="h-full flex flex-col justify-between max-w-[600px] bg-white rounded-xl p-6 border border-gray-100 hover:shadow-sm transition-all duration-300 group cursor-pointer"
                >
                  <div className="flex items-start justify-between space-y-6">

                    <div className="flex items-center gap-4 text-sm text-gray-500">
                      <span className="flex items-center gap-1 text-[8px]">
                        <MapPin className="w-3.5 h-3.5" />
                        {job.location}
                      </span>

                      <span className="flex items-center gap-1 text-[8px] capitalize">
                        <Briefcase className="w-3.5 h-3.5" />
                        {job.employment_type?.replace('_', ' ')}
                      </span>

                      <span className="flex items-center gap-1 text-[8px]">
                        <Briefcase className="w-3.5 h-3.5" />
                        {job.job_category?.name}
                      </span>

                    </div>

                    <span className="text-[10px] text-gray-400">
                      {new Date(job.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}
                    </span>

                  </div>


                  <div className="mb-2">
                    <h3 className="text-xl font-semibold text-gray-900  transition-colors mb-2">
                      {job.title}
                    </h3>

                    <div className="text-[11px] text-gray-400 line-clamp-3" dangerouslySetInnerHTML={{ __html: job.description }}>
                    </div>
                  </div>

                  <div className="mt-4">
                    <Link
                      href={`/career/${job.slug}`}
                      className="text-xs font-medium text-blue-600 hover:text-blue-800 transition-colors">
                      View Details →
                    </Link>
                  </div>
                </motion.div>
              ))
            ) : (
              <div className="col-span-full text-center py-10 text-gray-500">
                Tidak ada lowongan tersedia saat ini.
              </div>
            )}
          </div>

          <div className="text-center mt-10">
            <button className="px-6 py-3 bg-white border-2 border-[#003B65] text-[#003B65] font-semibold rounded-xl hover:bg-[#003B65] hover:text-white 
            transition-all duration-300 cursor-pointer text-[15px]">
              View All Positions
            </button>
          </div>
        </div>
      </section>
    </div>
  )
}
