"use client"
import { useState, useEffect, useRef } from "react";

export default function Counter({ target, suffix = "" }: { target: number; suffix?: string }) {
    const [count, setCount] = useState(0);
    const ref = useRef<HTMLDivElement>(null);
    const [started, setStarted] = useState(false);

    useEffect(() => {
        const observer = new IntersectionObserver(
            ([entry]) => {
                if (entry.isIntersecting) {
                    setStarted(true);
                }
            },
            { threshold: 0.5 }
        )
        if (ref.current) observer.observe(ref.current)
        return () => observer.disconnect()
    }, []);

    useEffect(() => {
        if (!started) return;

        const duration = 2000;
        const steps = 60;
        const increment = target / steps;
        const interval = duration / steps;

        let current = 0;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                setCount(target);
                clearInterval(timer);
            } else {
                setCount(Math.ceil(current));
            }
        }, interval);

        return () => clearInterval(timer);
    }, [started, target]);

    return (
        <div ref={ref} className="text-inherit">
            {count}{suffix}
        </div>
    );
}