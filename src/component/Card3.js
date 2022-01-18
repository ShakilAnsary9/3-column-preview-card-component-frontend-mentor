import React from "react";
import "../component/Card.css";
import icon3 from "../component/images/icon-luxury.svg";

function Card3() {
  return (
    <div className="card-three">
      <div className="icon-bg" style={{ backgroundImage: `url(${icon3})` }}>
        <div className="icon"></div>
      </div>
      <div className="title">
        <h3>Luxury</h3>
      </div>
      <p className="description">
        Cruise in the best car brands without the bloated prices. Enjoy the
        enhanced comfort of a luxury rental and arrive in style.
      </p>
      <button className="btn3">Learn More</button>
    </div>
  );
}

export default Card3;
