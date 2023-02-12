import axios from "axios";
import React, { useEffect, useState } from "react";
import Spinner from "../Components/Spinner";
import SmallSpinner from "../Components/SmallSpinner";

export default function Cart() {
    const [loader, setLoader] = useState(true);
    const [cart, setCart] = useState([]);
    const [qtyLoader, setQtyLoader] = useState(false);
    const [showCheckout, setShowCheckout] = useState(false);

    const user_id = window.auth.id;
    useEffect(() => {
        axios.get("/api/get-cart?user_id=" + user_id).then((d) => {
            const { data } = d;
            setCart(data.data);
            setLoader(false);
            showCheckout(false);
        });
    }, []);

    // update Cart
    const updateCart = (id, type) => {
        const updatedCart = cart.map((d) => {
            if (id == d.id) {
                switch (type) {
                    case "add":
                        d.total_quantity += 1;
                        break;
                    default:
                        d.total_quantity -= 1;
                        break;
                }
            }
            return d;
        });
        setCart(updatedCart);
    };

    //update cart qty in database
    const updateCartQty = (id, qty) => {
        setQtyLoader(id);
        axios
            .post("/api/update-cart-qty", { cart_id: id, qty: qty })
            .then((d) => {
                if (d.data.message === true) {
                    showToast("Cart Updated Successfully");
                    setQtyLoader(false);
                }
            });
    };

    //remove cart
    const removeCart = (id) => {
        axios.post("/api/remove-cart", { cart_id: id }).then((d) => {
            if (d.data.message === true) {
                setCart((prevCart) => {
                    showToast("Cart deleted successfully.");
                    return prevCart.filter((d) => d.id !== id);
                });
            }
        });
    };

    //total price
    const TotalPrice = () => {
        var total_price = 0;
        cart.map((d) => {
            total_price += d.total_quantity * d.product.sale_price;
        });
        return total_price;
    };

    //checkout
    function checkout() {
        const user_id = window.auth.id;
        axios.post("/api/checkout?user_id=" + user_id).then((d) => {
            if (d.data.message === true) {
                showToast("Check out successfully");
                setShowCheckout(false);
                setCart([]);
            }
        });
    }

    return (
        <div className="container-fluid my-3">
            <div className="card p-3">
                <h4>Cart</h4>
                {loader && <Spinner />}
                {!loader && (
                    <>
                        <table className="table table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Sale Price</th>
                                    <th>Add/Remove</th>
                                    <th>Delete</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                {cart.map((d) => (
                                    <tr key={d.id}>
                                        <td>
                                            <img
                                                width="80px"
                                                src={d.product.img_url}
                                                alt={d.product.name}
                                            />
                                        </td>
                                        <td>{d.product.name}</td>
                                        <td>{d.total_quantity}</td>
                                        <td>{d.product.sale_price}</td>
                                        <td>
                                            <button
                                                className="btn btn-sm btn-dark"
                                                onClick={() =>
                                                    updateCart(d.id, "reduce")
                                                }
                                            >
                                                -
                                            </button>
                                            <input
                                                type="text"
                                                value={d.total_quantity}
                                                className="btn border-warning"
                                                disabled={true}
                                            />
                                            <button
                                                className="btn btn-sm btn-dark"
                                                onClick={() =>
                                                    updateCart(d.id, "add")
                                                }
                                            >
                                                +
                                            </button>
                                            <button
                                                className="btn btn-primary btn-sm"
                                                onClick={() =>
                                                    updateCartQty(
                                                        d.id,
                                                        d.total_quantity
                                                    )
                                                }
                                            >
                                                {qtyLoader === d.id && (
                                                    <SmallSpinner />
                                                )}
                                                Save
                                            </button>
                                        </td>
                                        <td>
                                            <button
                                                className="btn btn-danger"
                                                onClick={() => removeCart(d.id)}
                                            >
                                                <i className="fa fa-trash"></i>
                                            </button>
                                        </td>
                                        <td className="bg-dark text-white">
                                            {d.total_quantity *
                                                d.product.sale_price}
                                        </td>
                                    </tr>
                                ))}
                                <tr>
                                    <td colSpan={6}>
                                        <span className="float-right">
                                            Total :
                                        </span>
                                    </td>
                                    <td>
                                        <TotalPrice />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        {/* {!showCheckout && (
                            <h1 className="text-center">Your cart is empty</h1>
                        )}

                        {showCheckout && (
                            
                        )} */}
                        <div>
                            <button
                                className="btn btn-primary"
                                onClick={() => checkout()}
                            >
                                Checkout
                            </button>
                        </div>
                    </>
                )}
            </div>
        </div>
    );
}
