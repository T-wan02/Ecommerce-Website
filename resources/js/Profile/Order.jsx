import axios from "axios";
import React, { useEffect, useState } from "react";
import Spinner from "../Components/Spinner";

export default function Order() {
    const [loader, setLoader] = useState(true);
    const [order, setOrder] = useState({});
    const [page, setPage] = useState(1);

    useEffect(() => {
        const user_id = window.auth.id;
        axios
            .get(`/api/order?page=${page}&user_id=${user_id}`)
            .then(({ data }) => {
                setOrder(data.data);
                // console.log(data.data);
                setLoader(false);
            });
    }, [page]);

    return (
        <>
            {loader && <Spinner />}
            {!loader && (
                <>
                    <table className="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Total Quantity</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            {order.data.map((d) => (
                                <tr key={d.id}>
                                    <td>{d.product.name}</td>
                                    <td>
                                        <img
                                            src={d.product.img_url}
                                            alt={d.product.name}
                                            width="50px"
                                        />
                                    </td>
                                    <td>{d.total_quantity}</td>
                                    <td>
                                        {d.product.sale_price *
                                            d.total_quantity}
                                        ks
                                    </td>
                                    <td>
                                        {d.status === "pending" && (
                                            <span className="badge badge-warning">
                                                Pending
                                            </span>
                                        )}
                                        {d.status === "success" && (
                                            <span className="badge badge-success">
                                                Success
                                            </span>
                                        )}
                                        {d.status === "cancel" && (
                                            <span className="badge badge-danger">
                                                Cancel
                                            </span>
                                        )}
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                    <div className="text-center">
                        <button
                            className="btn btn-dark"
                            disabled={
                                order.prev_page_url === null ? true : false
                            }
                            onClick={() => setPage(page - 1)}
                        >
                            <i className="fa fa-arrow-left"></i>
                        </button>
                        <button
                            className="btn btn-dark"
                            disabled={
                                order.next_page_url === null ? true : false
                            }
                            onClick={() => setPage(page + 1)}
                        >
                            <i className="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </>
            )}
        </>
    );
}
