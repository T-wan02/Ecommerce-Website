import axios from "axios";
import React, { useState } from "react";
import StarRating from "react-star-ratings";
import Spinner from "../../Components/Spinner";

export default function Review({ review }) {
    const [comment, setComment] = useState("");
    const [rating, setRating] = useState(0);
    const [reviewList, setReviewList] = useState(review);
    const disableReview = rating && comment !== "" ? false : true;

    const [loader, setLoader] = useState(false);

    function submitReview() {
        const user_id = window.auth.id;
        const slug = window.product_slug;
        const data = { comment, rating, slug, user_id };
        axios.post("/api/make-review/" + slug, data).then(({ data }) => {
            // console.log(data);
            if (data.message === false) {
                showToast("product not found");
            } else {
                setReviewList([...reviewList, data.data]);
                setLoader(false);
                setComment("");
                setRating(0);
            }
        });
    }

    return (
        <div className="col-12" style={{ marginTop: "100px" }}>
            {/* loop review */}
            {reviewList.map((d) => (
                <div className="review" key={d.id}>
                    <div className="card p-3">
                        <div className="row">
                            <div className="col-md-2">
                                <div className="d-flex justify-content-between">
                                    <img
                                        className="w-100 rounded-circle"
                                        src="assets/images/user.jpeg"
                                        alt=""
                                    />
                                </div>
                            </div>
                            <div className="col-md-10">
                                <StarRating
                                    starRatedColor="#FB6540"
                                    starDimension="20px"
                                    // changeRating={(rate) => alert(rate)}
                                    rating={d.rating}
                                    numberOfStars={5}
                                    name="rating"
                                />
                                <div className="name">
                                    <b>{d.user.name}</b>
                                </div>
                                <div className="mt-3">
                                    <small>{d.review}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ))}

            {loader && <Spinner />}

            {!loader && (
                <div className="add-review mt-5">
                    <h4>Make Review</h4>
                    <StarRating
                        starHoverColor="#FB6540"
                        changeRating={(rate) => setRating(rate)}
                        numberOfStars={5}
                        rating={rating}
                        name="rating"
                    />
                    <div>
                        <textarea
                            value={comment}
                            className="form-control"
                            rows={5}
                            placeholder="enter review"
                            onChange={(e) => setComment(e.target.value)}
                        />
                        <button
                            className="btn btn-dark float-right mt-3"
                            disabled={disableReview}
                            onClick={() => submitReview()}
                        >
                            Review
                        </button>
                    </div>
                </div>
            )}
        </div>
    );
}
