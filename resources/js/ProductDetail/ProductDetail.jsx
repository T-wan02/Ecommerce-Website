import axios from "axios";
import React, { useEffect, useState } from "react";
import Spinner from "../Components/Spinner";
import Review from "./Components/Review";
import SmallSpinner from "../Components/SmallSpinner";

export default function ProductDetail() {
    const [product, setProduct] = useState({});
    const [loader, setLoader] = useState(true);
    const [cartLoader, setCartLoader] = useState(false);

    const product_slug = window.product_slug;

    useEffect(() => {
        axios.get("/api/product/" + product_slug).then(({ data }) => {
            //     if(!data.message){
            //           setProduct(data)
            //     }
            setProduct(data.data);
            setLoader(false);
        });
    }, []);

    function addToCart() {
        if (window.auth.id !== null) {
            setCartLoader(true);
            const user_id = window.auth.id;
            axios
                .post("/api/add-tocart/" + product_slug, { user_id })
                .then((d) => {
                    // console.log(d);
                    const { data } = d;
                    console.log(data.data);
                    if (data.message === false) {
                        showToast("Product Not found.");
                    } else {
                        window.checkCart(data.data);
                        showToast("Product Added to cart.");
                        setCartLoader(false);
                    }
                });
        } else {
            showToast("login first");
        }
    }

    return (
        <React.Fragment>
            {loader && <Spinner />}
            {!loader && (
                <div className="card p-4">
                    <div className="row">
                        <div className="col-12 mb-3">
                            <h3>{product.name}</h3>
                            <div>
                                <small className="text-muted">Brand:</small>
                                <small>{product.brand.name}</small>|
                                <small className="text-muted">Category:</small>
                                <small className="badge badge-dark">
                                    {product.category.name}
                                </small>
                            </div>
                        </div>
                        <div className="col-12 col-sm-12 col-md-4 col-lg-4">
                            <img
                                className="w-100"
                                src={product.img_url}
                                alt=""
                            />
                        </div>
                        <div className="col-12 col-sm-12 col-md-8 col-lg-8">
                            <div className="mt-5">
                                <p>
                                    <small className="text-muted">
                                        <strike>{product.sale_price}ks</strike>
                                    </small>
                                    <span className="text-danger fs-1 d-inline">
                                        {product.discount_price}ks
                                    </span>
                                    <br />
                                    <span className="btn btn-sm btn-outline-success text-success mt-3">
                                        InStock :{product.total_quantity}
                                    </span>
                                    <span
                                        className="btn btn-sm btn-danger mt-3"
                                        onClick={() => addToCart()}
                                    >
                                        {cartLoader && (
                                            <>
                                                <SmallSpinner />
                                            </>
                                        )}
                                        <i className="fas fa-shopping-cart" />
                                        Add To Cart
                                    </span>
                                </p>
                                <p
                                    className="mt-5"
                                    dangerouslySetInnerHTML={{
                                        __html: product.description,
                                    }}
                                ></p>
                                <small className="text-muted">
                                    Available Color:
                                </small>
                                {product.color.map((d) => (
                                    <span
                                        className="badge badge-danger"
                                        key={d.id}
                                    >
                                        {d.name}
                                    </span>
                                ))}
                            </div>
                        </div>
                        <hr />
                        <Review review={product.review} />
                    </div>
                </div>
            )}
        </React.Fragment>
    );
}
