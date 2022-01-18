import React from "react";
import "../component/Card.css";
import icon2 from "../component/images/icon-suvs.svg";

function Card2() {
  return (
    <div className="card-two">
      <div className="icon-bg" style={{ backgroundImage: `url(${icon2})` }}>
        <div className="icon"></div>
      </div>
      <div className="title">
        <h3>Suvs</h3>
      </div>
      <p className="description">
        Take an SUV for its spacious interior, power, and versatility. Perfect
        for your next family vacation and off-road adventures.
      </p>
      <button className="btn2">Learn More</button>
    </div>
  );
}

export default Card2;
