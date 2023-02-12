import axios from "axios";
import React, { useState, useEffect } from "react";
import Spinner from "../Components/Spinner";

export default function Home() {
    const [category, setCategory] = useState([]);
    const [featuredProduct, setFeaturedProduct] = useState([]);
    const [productByCategory, setProductByCategory] = useState([]);
    const [loader, setLoader] = useState(true);

    function fetchData() {
        axios.get("/api/home").then((d) => {
            // console.log(d.data.data.category);
            const { category, featuredProduct, productByCategory } = d.data;

            console.log(d.data);
            setCategory(category);
            setFeaturedProduct(featuredProduct);
            setProductByCategory(productByCategory);
            setLoader(false);
        });
    }

    useEffect(() => {
        fetchData();
    }, []);

    return (
        <React.Fragment>
            {loader && <Spinner />}
            {/* category list */}

            {!loader && (
                <React.Fragment>
                    <div className="w-80 mt-5">
                        <div className="row mt-2">
                            {/* loop category */}
                            {category.map((d) => (
                                <div
                                    className="col-12 col-sm-12 col-md-3 col-lg-3 border"
                                    key={d.slug}
                                >
                                    <a
                                        href={`/product?category=${d.slug}`}
                                        className="text-dark"
                                    >
                                        <div className="d-flex justify-content-around align-items-center p-3">
                                            <img
                                                src={d.img_url}
                                                width={100}
                                                height={100}
                                                alt=""
                                            />
                                            <div className="text-center">
                                                <p className="fs-2">
                                                    {window.locale === "mm"
                                                        ? d.mm_name
                                                        : d.name}
                                                </p>
                                                <small>
                                                    {d.product_count} items
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            ))}
                        </div>
                    </div>
                    <div className="w-80 mt-5">
                        <div className="row">
                            <div className="col-12 col-sm-12 col-md-3 col-lg-3 ">
                                {featuredProduct.map((d) => (
                                    <a
                                        href={`/product?category=${d.slug}`}
                                        key={d.slug}
                                    >
                                        <div className="border bg-warning p-5 text-center rounded">
                                            <img
                                                src={d.img_url}
                                                className="w-80 margin-auto  rounded"
                                                alt=""
                                            />
                                            <div className="mt-5">
                                                <h4 className="text-center mt-4 text-white">
                                                    {d.name}
                                                </h4>
                                                <span className="text badge badge-white">
                                                    {d.sale_price}ks
                                                </span>
                                                <span className="text badge badge-danger">
                                                    <strike>
                                                        {d.discount_price}ks
                                                    </strike>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                ))}
                            </div>
                            <div className="col-12 col-sm-12 col-md-9 col-lg-9">
                                <div className="row">
                                    {/* products */}
                                    {productByCategory.map((d) => (
                                        <div
                                            className="col-12 col-sm-12 col-md-12 col-lg-12 mt-3 product"
                                            key={d.slug}
                                        >
                                            <div className="row">
                                                <div className="col-12">
                                                    <div className="d-flex justify-content-between align-items-center">
                                                        <b className="fs-1">
                                                            {d.name}
                                                        </b>
                                                        <a
                                                            href={`/product?category=${d.slug}`}
                                                            className="btn btn-warning"
                                                        >
                                                            View All
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="row">
                                                {/* loop product */}
                                                {d.product.map((d) => (
                                                    <div
                                                        className="col-12 col-md-4 text-center mt-2"
                                                        key={d.slug}
                                                    >
                                                        <a
                                                            href={`/product/${d.slug}`}
                                                        >
                                                            <div className="card p-2">
                                                                <img
                                                                    src={
                                                                        d.img_url
                                                                    }
                                                                    alt=""
                                                                    className="w-100"
                                                                />
                                                                <b>{d.name}</b>
                                                                <div>
                                                                    <small className=" badge badge-danger">
                                                                        <strike>
                                                                            {
                                                                                d.discount_price
                                                                            }
                                                                            ks
                                                                        </strike>
                                                                    </small>
                                                                    <small className="badge bg-primary">
                                                                        {
                                                                            d.sale_price
                                                                        }
                                                                        ks
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                ))}
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        </div>
                    </div>
                </React.Fragment>
            )}
        </React.Fragment>
    );
}
