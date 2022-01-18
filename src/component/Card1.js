import React from "react";
import "../component/Card.css";
import icon1 from "../component/images/icon-sedans.svg";

function Card1() {
  return (
    <div className="card-one">
      <div className="icon-bg" style={{ backgroundImage: `url(${icon1})` }}>
        <div className="icon"></div>
      </div>
      <div className="title">
        <h3>Seadans</h3>
      </div>
      <p className="description">
        Choose a sedan for its affordability and excellent <br /> fuel economy.
        Ideal for <br /> cruising in the city or on <br /> your next road trip.
      </p>
      <button className="btn1">Learn More</button>
    </div>
  );
}

export default Card1;
