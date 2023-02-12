import axios from "axios";
import React, { useEffect, useState } from "react";
import SmallSpinner from "../Components/SmallSpinner";

const Password = () => {
    const [loader, setLoader] = useState(false);
    const [currentPassword, setCurrentPassword] = useState("");
    const [newPassword, setNewPassword] = useState("");
    const [confirmPassword, setConfirmPassword] = useState("");

    const changePassword = () => {
        setLoader(true);

        if (newPassword !== confirmPassword) {
            showToast("Password Don't Match", "error");
            setLoader(false);
        } else {
            axios
                .post("/api/change-password?user_id=" + window.auth.id, {
                    currentPassword,
                    newPassword,
                })
                .then((d) => {
                    const { data } = d;
                    if (data.message === false) {
                        showToast("Password Wrong");
                        setLoader(false);
                    } else {
                        showToast("Password Changed Successfully.");
                        setLoader(false);
                    }
                });
        }
    };

    return (
        <div className="container mt-3">
            <div className="card p-4">
                <h2>Change Password</h2>
                <div>
                    <div className="form-group">
                        <label htmlFor="">Enter Current Password</label>
                        <input
                            type="password"
                            className="form-control"
                            onChange={(e) => setCurrentPassword(e.target.value)}
                        />
                    </div>
                    <div className="form-group">
                        <label htmlFor="">Enter New Password</label>
                        <input
                            type="password"
                            className="form-control"
                            onChange={(e) => setNewPassword(e.target.value)}
                        />
                    </div>
                    <div className="form-group">
                        <label htmlFor="">Confirm New Password</label>
                        <input
                            type="password"
                            className="form-control"
                            onChange={(e) => setConfirmPassword(e.target.value)}
                        />
                    </div>
                    <div>
                        <button
                            className="btn btn-dark"
                            onClick={() => changePassword()}
                        >
                            {loader && <SmallSpinner />}
                            Change Password
                        </button>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Password;
