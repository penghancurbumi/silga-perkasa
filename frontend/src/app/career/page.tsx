"use client"
import { useState } from "react"
import Image from "next/image"
import { Search, MapPin, Briefcase, ChevronDown } from "lucide-react"
import Counter from "@/component/counter"

export default function Career() {
  const [searchQuery, setSearchQuery] = useState("")
  const [location, setLocation] = useState("")
  const [category, setCategory] = useState("")

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
          <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold text-white text-center mb-4 tracking-tight">
            Temukan Peluang Karier Anda
          </h1>
          <p className="text-sm md:text-md text-white/80 text-center mb-10 max-w-2xl">
            Jelajahi berbagai lowongan yang tersedia dan gunakan pencarian di bawah untuk menemukan posisi yang sesuai dengan keahlian, minat, atau lokasi yang Anda inginkan.
          </p>

          {/* Search Bar */}
          <div className="w-full max-w-5xl">
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
                  <option value="engineering">Engineering</option>
                  <option value="marketing">Marketing</option>
                  <option value="finance">Finance</option>
                  <option value="operations">Operations</option>
                  <option value="hr">Human Resources</option>
                </select>
                <ChevronDown className="w-4 h-4 text-gray-400 absolute right-4" />
              </div>

              {/* Search Button */}
              <button className="px-8 py-3 bg-[#003B65] text-white font-semibold rounded-lg transition-all duration-300 shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:scale-[1.02] active:scale-[0.98] whitespace-nowrap cursor-pointer">
                Search Jobs
              </button>
            </div>
          </div>
        </div>
      </section>

      {/* Stats Section */}
      <section className="bg-white border-b border-gray-100">
        <div className="max-w-6xl mx-auto px-4 py-10 grid grid-cols-2 md:grid-cols-4 gap-6">

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
        </div>
      </section>

      {/* Featured Jobs Preview */}
      <section className="bg-gray-50 flex-1">
        <div className="max-w-[1200px] mx-auto py-14">
          <div className="text-center mb-12">
            <h2 className="text-3xl font-bold text-gray-900 mb-3">Featured Opportunities</h2>
            <p className="text-gray-500 max-w-xl mx-auto">Explore our latest openings and find the perfect role for you</p>
          </div>

          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            {[
              {
                title: "Heavy Equipment Operator",
                location: "Kalimantan Tengah",
                type: "Full-time",
                dept: "Operations",
                posted: "2 days ago",
                description: "Responsible for operating heavy machinery such as excavators, bulldozers, and dump trucks in coal mining operations. Must follow safety protocols and maintain equipment logs.",
              },
              {
                title: "Site Engineer",
                location: "Kalimantan Selatan",
                type: "Full-time",
                dept: "Engineering",
                posted: "3 days ago",
                description: "Oversee technical aspects of mining site operations, prepare engineering reports, and coordinate with project managers to ensure work is completed on schedule and within budget.",
              },
              {
                title: "Safety Officer",
                location: "Kalimantan Timur",
                type: "Full-time",
                dept: "HSE",
                posted: "5 days ago",
                description: "Monitor and enforce health, safety, and environmental standards on site. Conduct risk assessments, safety audits, and lead emergency response planning.",
              },
              {
                title: "Finance Staff",
                location: "Jakarta",
                type: "Full-time",
                dept: "Finance",
                posted: "1 week ago",
                description: "Handle financial reporting, budgeting, and bookkeeping activities. Support monthly closing processes and liaise with external auditors and tax consultants.",
              },
              {
                title: "HR Recruitment",
                location: "Jakarta",
                type: "Full-time",
                dept: "Human Resources",
                posted: "1 week ago",
                description: "Manage end-to-end recruitment processes including job posting, candidate screening, interviews, and onboarding. Build talent pipelines for operational and corporate roles.",
              },
              {
                title: "Truck Driver",
                location: "Kalimantan Tengah",
                type: "Contract",
                dept: "Operations",
                posted: "3 days ago",
                description: "Transport coal and materials between mining sites and loading points. Must hold a valid SIM B2 license and have experience driving heavy-duty trucks in off-road conditions.",
              },
            ].map((job, i) => (
              <div
                key={i}
                className="max-w-[500px] bg-white rounded-xl p-6 border border-gray-100 hover:shadow-sm transition-all duration-300 group cursor-pointer"
              >
                <div className="flex items-start justify-between space-y-6">

                  <div className="flex items-center gap-4 text-sm text-gray-500">
                    <span className="flex items-center gap-1 text-[8px]">
                      <MapPin className="w-3.5 h-3.5" />
                      {job.location}
                    </span>

                    <span className="flex items-center gap-1 text-[8px]">
                      <Briefcase className="w-3.5 h-3.5" />
                      {job.type}
                    </span>

                    <span className="flex items-center gap-1 text-[8px]">
                      <Briefcase className="w-3.5 h-3.5" />
                      {job.dept}
                    </span>

                  </div>

                  <span className="text-[8px] text-gray-400">{job.posted}</span>

                </div>


                <div className="mb-2">
                  <h3 className="text-xl font-semibold text-gray-900  transition-colors mb-2">
                    {job.title}
                  </h3>

                  <p className="text-[10px] text-gray-500 line-clamp-3">
                    {job.description}
                  </p>
                </div>

                <div className="mt-4">
                  <span className="text-xs font-medium text-blue-600 ">
                    View Details →
                  </span>
                </div>
              </div>
            ))}
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
