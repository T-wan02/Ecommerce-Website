import React from "react";
import { createRoot } from "react-dom/client"
import { HashRouter, Routes, Route, Link } from "react-router-dom";
import Home from "./Home/Home";

const MainRouter = () => {
     return(
          <HashRouter>
               <Routes>
                    <Route path="/" element={<Home/>} />
               </Routes>
          </HashRouter>
     )
}

createRoot(document.getElementById('root')).render(<MainRouter/>);