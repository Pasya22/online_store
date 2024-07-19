"use client";
import styles from "../../public/css/navbar.css";
import React, { useState, useEffect, useRef } from "react";

const Navbar = () => {
    const [isSidbarOpen, setIsSidebarOpen] = useState(false);
    const [activeItem, setActiveItem] = useState('');
    const cardPropilRef = useRef(null);

    const togglepropil = () => {
        setIsSidebarOpen(!isSidbarOpen);
    };

    const handleClickOutside = (event) => {
        if (cardPropilRef.current && !cardPropilRef.current.contains(event.target)) {
            setIsSidebarOpen(false);
        }
    };

    const handleScrollOutside = () => {
        if (isSidbarOpen) {
            setIsSidebarOpen(false);
        }
    };

    useEffect(() => {
        document.addEventListener("mousedown", handleClickOutside);
        document.addEventListener("scroll", handleScrollOutside);

        return () => {
            document.removeEventListener("mousedown", handleClickOutside);
            document.removeEventListener("scroll", handleScrollOutside);
        };
    }, [isSidbarOpen]);

    return (
        <div className="navbarr">
            <div className="grubpropil">
                <span>
                    <i className="fa-solid fa-comment-dots"></i>
                </span>
                <div className="propil">
                    <div className="spanprofil">
                        <i className="fa-solid fa-user-secret"></i>
                    </div>
                    <div className="namapropil">
                        <h5>😋🌙😜😝</h5>
                        <span onClick={togglepropil}>
                            <i className={`fa-solid fa-caret-down ${isSidbarOpen ? "open" : ""}`}></i>
                        </span>
                    </div>
                </div>
                <div ref={cardPropilRef} className={`cardpropil ${isSidbarOpen ? "open" : ""}`}>
                    <div className="isicardpropil garis">
                        <h4>Profil</h4>
                    </div>
                    <div className="isicardpropil">
                        <h4>Logout</h4>
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Navbar;
