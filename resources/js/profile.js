import React from "react";
import { createRoot } from "react-dom/client"
import { HashRouter, Routes, Route, Link } from "react-router-dom";
import Cart from './Profile/Cart';
import Nav from "./Profile/Components/Nav";
import Order from './Profile/Order';
import Password from "./Profile/Password";
import Profile from "./Profile/Profile";

const MainRouter = () => {
     return(
          <HashRouter>
               <Nav />
               {/* <div className="container-fluid mt-3">
                    <div className="card p-3 bg-dark">
                         <div>
                              <Link to={'/'} className="btn btn-warning">cart list</Link>
                              <Link to={'/order'} className="btn btn-outline-warning">order list</Link>
                              <Link to={'/profile'} className="btn btn-outline-warning">profile</Link>
                              <Link to={'/change-password'} className="btn btn-outline-warning">change password</Link>
                         </div>
                    </div>
               </div> */}
               <Routes>
                    <Route path="/" element={<Cart />} />
                    <Route path="/order" element={<Order />} />
                    <Route path="/profile" element={<Profile />} />
                    <Route path="/profile" element={<Profile />} />
                    <Route path="/password" element={<Password />} />
               </Routes>
          </HashRouter>
     )
}

createRoot(document.getElementById('root')).render(<MainRouter/>);