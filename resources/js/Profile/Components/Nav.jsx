import React, { Fragment, useState } from "react";
import { Link, useLocation } from "react-router-dom";

export default function Nav() {
    const { pathname } = useLocation();

    return (
        <div className="container-fluid mt-3">
            <div className="card p-3 bg-dark text-center">
                <div>
                    <Link
                        to={"/"}
                        className={`btn btn${
                            pathname === "/" ? "" : "-outline"
                        }-warning`}
                    >
                        cart list
                    </Link>
                    <Link
                        to={"/order"}
                        className={`btn btn${
                            pathname === "/order" ? "" : "-outline"
                        }-warning`}
                    >
                        order list
                    </Link>
                    <Link
                        to={"/profile"}
                        className={`btn btn${
                            pathname === "/profile" ? "" : "-outline"
                        }-warning`}
                    >
                        profile
                    </Link>
                    <Link
                        to={"/password"}
                        className={`btn btn${
                            pathname === "/password" ? "" : "-outline"
                        }-warning`}
                    >
                        change password
                    </Link>
                </div>
            </div>
        </div>
    );
}
