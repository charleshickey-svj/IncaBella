/*
  Inca Bella hire collection: the one file to edit for products and prices.

  Each product:
    slug         short web name, used in links (letters, numbers and dashes only)
    name         shown on the site
    price        in pounds, a plain number (1000 not "£1,000.00")
    group        one of the group ids in INCABELLA_GROUPS below
    images       file names in assets/img/products/ (the first one is the main photo)
    description  shown on the product page; a blank line starts a new paragraph
*/
window.INCABELLA_GROUPS = [
  {
    "id": "packages",
    "name": "Packages",
    "blurb": "Let Lucy style a whole room, the ceremony or your tables."
  },
  {
    "id": "lanterns",
    "name": "Lanterns & candles",
    "blurb": "Lanterns, tealights and vases, priced per item."
  },
  {
    "id": "lights",
    "name": "Lights",
    "blurb": "Fairy lights and light-up letters, fitted by Lucy."
  },
  {
    "id": "props",
    "name": "Props & décor",
    "blurb": "Post boxes, crates, churns and the finishing details."
  },
  {
    "id": "outdoor",
    "name": "Outdoor & greenery",
    "blurb": "Firepit, hay bales and potted olive trees."
  },
  {
    "id": "games",
    "name": "Garden games & kids",
    "blurb": "Giant games for the lawn and a play tent for little guests."
  }
];

window.INCABELLA_PRODUCTS = [
  {
    "slug": "full-decoration-package-silver",
    "name": "Full Decoration Package – Tier 1",
    "price": 695.0,
    "group": "packages",
    "images": [
      "full-decoration-package-silver-1.jpg",
      "full-decoration-package-silver-2.jpg",
      "full-decoration-package-silver-3.jpg",
      "full-decoration-package-silver-4.jpg"
    ],
    "description": "Take the stress out of doing it yourself and let Incabella do a full wedding set-up. From £695 this package covers the decoration of all three floors of the mill.\n\nThe set up includes the following:\n\nFull Downstairs set-up:\n\nFull decoration of the downstair floor including the river window, your choice of post box, along with a large number of lanterns / t-lights / crates / potted flowers to make the ground floor look stunning\n\nCeremony room set-up to include:\n\nOn each corner of the stage: One Large White Wooden Lantern set on a crate along with at least 5 Glass Tall Vases / Hurricane Lanterns all with candles with lots of fresh greenery. Down the aisle: At the end of every other row, Mohani Lantern or a Large Glass Hurricane Lamp set on a log slice with candle. If you would like the outdoor ceremony instead there is a £50 supplement.\n\nTable Centre Pieces:\n\nIncabella will move your chosen aisle ends to become your table centre pieces (based on 8-10 round tables or 8 round tables and one top table of two tables long), the tables will also have the addition of a table number frame and t-lights\n\nOptional extras that can be added at an additional cost include greenery garlands / chair sashes / fairy lights / garden games / firepit / additional flowers / bouquets and button holes."
  },
  {
    "slug": "full-decoration-package-tier-2",
    "name": "Full Decoration Package – Tier 2",
    "price": 1000.0,
    "group": "packages",
    "images": [
      "full-decoration-package-tier-2-1.jpg",
      "full-decoration-package-tier-2-2.jpg",
      "full-decoration-package-tier-2-3.jpg"
    ],
    "description": "Take the stress out of doing it yourself and let Incabella do a full wedding set-up. From £1000 this package covers the decoration of all three floors of the mill.\n\nThe set up includes the following:\n\nFull Downstairs set-up:\n\nFull decoration of the downstair floor including the river window, your choice of post box, along with a large number of lanterns / t-lights / crates / potted flowers to make the ground floor look stunning\n\nCeremony room set-up to include:\n\nOn each corner of the stage: One Large White Wooden Lantern set on a crate along with at least 5 Glass Tall Vases / Hurricane Lanterns all with candles with lots of fresh greenery. Down the aisle: At the end of every other row, Mohani Lantern or a Large Glass Hurricane Lamp set on a log slice with candle. White sash on each aisle end chair.\n\nNet of fairy lights along back wall in the ceremony room and fairy lights zig zagged across the ceremony room ceiling\n\nTable Centre Pieces:\n\nIncabella will move your chosen aisle ends to become your table centre pieces (based on 8-10 round tables or 8 round tables and one top table of two tables long), the tables will also have the addition of a table number frame and t-lights. Also includes greenery runner along top table.\n\nOptional extras that can be added at an additional cost include greenery garlands / aisle runner / arch / garden games / firepit / additional flowers / bouquets and button holes."
  },
  {
    "slug": "ground-floor-decoration-package",
    "name": "Ground Floor Decoration Package",
    "price": 245.0,
    "group": "packages",
    "images": [
      "ground-floor-decoration-package-1.jpg",
      "ground-floor-decoration-package-2.jpg",
      "ground-floor-decoration-package-3.jpg",
      "ground-floor-decoration-package-4.jpg"
    ],
    "description": "Let Incabella decorate the bottom floor of Sopley Mill to make it look wonderful .\n\nThe set up includes the following:\n\nThe River Window Display (normally £105, see further details)\n\nChoice of Post Box, set up with flowers / t-lights\n\nHeart Light\n\nMoroccan Lantern\n\nMany additional lanterns and t-lights\n\nExtra t-lights\n\nPotted flowers\n\nSmall potted trees such as Olives\n\nIncludes set up on the morning of your wedding. Please do speak to Lucy as to what flowers are likely to be in season for your wedding date or if you are working towards any particular colour schemes."
  },
  {
    "slug": "outdoor-ceremony-set-up",
    "name": "Outdoor Ceremony Set-Up",
    "price": 325.0,
    "group": "packages",
    "images": [
      "outdoor-ceremony-set-up-1.jpg",
      "outdoor-ceremony-set-up-2.jpg",
      "outdoor-ceremony-set-up-3.jpg",
      "outdoor-ceremony-set-up-4.jpg"
    ],
    "description": "A beautiful, rustic way to make an outdoor ceremony look beautiful\n\nThe set up includes the following: At the end of aisle, next to the signing table each corner will be decorated with crates / cut logs / lanterns and potted flowers. Down the central aisle each bench end will have a mixture of potted flowers / lanterns. It also includes two large potted Olive Trees.\n\nAdd in a beautiful wooden arch with billowing white material for £165\n\nThis is all set up on the morning of your wedding. It can be tailored to your exact requirements, i.e. substituting one type of lantern for another etc. However I can not normally confirm an exact potted flower type as it depends on what is growing at the time. Please note that once I have set this up outside I am not available to move it inside if the weather changes, I can of course though set it up inside rather than outside but do need to know by the night before."
  },
  {
    "slug": "ceremonyroomset-up",
    "name": "Ceremony Room Set-up",
    "price": 195.0,
    "group": "packages",
    "images": [
      "ceremonyroomset-up-1.jpg"
    ],
    "description": "A beautiful, rustic way to make the ceremony room look and smell lovely.\n\nThe set up includes the following: On each corner of the stage: One Large White Wooden Lantern set on a crate along with at least 5 Glass Tall Vases / Hurricane Lanterns all with candles. Down the aisle: At the end of every other row, Mohani Lantern or a Large Glass Hurricane Lamp set on a log slice with candle. £195\n\nAdd in lots of fresh greenery for an additional £80\n\nThis is all set up on the morning of your wedding. It can be tailored to your exact requirements, i.e. substituting one type of lantern for another etc. Additional items can also be added at a reduced price such as:\n\nTwo small milk churns with flower arrangement £135\n\nIvory Chair Sashes tied to chairs 20 for £50\n\nFairy lights, aisle runners, additional floristry also available, please do ask for costs."
  },
  {
    "slug": "riverwindowsetup",
    "name": "River Window Set-up",
    "price": 95.0,
    "group": "packages",
    "images": [
      "riverwindowsetup-1.jpg",
      "riverwindowsetup-2.jpg"
    ],
    "description": "Let Incabella decorate the alcove in the River Window to make it look fantastic\n\nThe set up includes lots of seasonal potted plants, olive tree, crates, small love letters, a large selection of t-lights and lanterns and crates to make the display look fab.\n\n£95 – Includes set up on the morning of your wedding. Please do speak to Lucy as to what flowers are likely to be in season for your wedding date or if you are working towards any particular colour schemes."
  },
  {
    "slug": "apple-crate-set-up",
    "name": "Apple Crate Set-Up",
    "price": 95.0,
    "group": "packages",
    "images": [
      "apple-crate-set-up-1.jpg"
    ],
    "description": "Let Incabella do a wonderful Apple Crate Set-Up, looks wonderful outside as your guests arrive .\n\nThe set up includes the following:\n\n5 Apple Crates\n\nA selection of lanterns / t-lights\n\nSelection of potted flowers /plants and small posies of flowers\n\nCan be set-up outside or in\n\nIncludes set up on the morning of your wedding. Please do speak to Lucy as to what flowers are likely to be in season for your wedding date or if you are working towards any particular colour schemes."
  },
  {
    "slug": "table-centre-piece-package",
    "name": "Table Centre Piece Package",
    "price": 25.0,
    "group": "packages",
    "images": [
      "table-centre-piece-package-1.jpg",
      "table-centre-piece-package-2.jpg",
      "table-centre-piece-package-3.jpg"
    ],
    "description": "A beautiful table centre piece that fills the room with warmth and elegance.\n\nEach table centre piece includes an antique brass Mohani lantern with candle set on a rustic wood slice surrounded by fresh greenery, along with 5 diamond glass t-lights as well as a pretty table number holder and card.\n\nPer table £25\n\nThere is also the option of using the wood slices and lanterns as aisle ends before being moved up to the tables for a small additional cost. Add in 3 small vases of flowers for £15 per table."
  },
  {
    "slug": "table-centre-piece-package-2",
    "name": "Table Centre Piece Package – 2",
    "price": 30.0,
    "group": "packages",
    "images": [
      "table-centre-piece-package-2-1.jpg",
      "table-centre-piece-package-2-2.jpg",
      "table-centre-piece-package-2-3.jpg",
      "table-centre-piece-package-2-4.jpg"
    ],
    "description": "A beautiful, elegant table centre piece that works just as well as an aisle end.\n\nEach table centre piece includes three glass cylinder vases of varying heights with either a pillar candle or the option of water and floating candles, set in the centre of the table along with greenery and a choice of table name / number frame. For the top table these look just as good set along the edge rather than in the centre.\n\nPer table £30\n\nThere is also the option of using the glass vase as aisle ends before being moved up to the tables for a small additional cost. These images show LED candles but real candles are also an option. Chair drapes and optional extras are also possible."
  },
  {
    "slug": "table-centre-piece-long-table",
    "name": "Table Centre Piece – Long table",
    "price": 35.0,
    "group": "packages",
    "images": [
      "table-centre-piece-long-table-1.jpg",
      "table-centre-piece-long-table-2.jpg"
    ],
    "description": "Ideal for rustic long tables.\n\nThis includes a greenery runner down the middle of the table interspersed with tall clear glass lanterns and t-lights.\n\nPer table £35"
  },
  {
    "slug": "ceiling-fairy-lights-ceremony-room",
    "name": "Ceiling Fairy lights – Ceremony Room",
    "price": 125.0,
    "group": "lights",
    "images": [
      "ceiling-fairy-lights-ceremony-room-1.jpg"
    ],
    "description": "Fairy lights zig zag across the ceiling of the ceremony room\n\nAdds a soft, romantic touch to the room\n\nWarm lights\n\nCombine with fairy lights net across the back wall for an additional £100\n\nReviews\n\nThere are no reviews yet.\n\nAdd a review\n\nBe the first to review “Ceiling Fairy lights – Ceremony Room” Cancel reply\nYour Review\nName *\n\nEmail *\n\nSave my name, email, and website in this browser for the next time I comment."
  },
  {
    "slug": "fairylight-wall-net-ceremony-room",
    "name": "Fairylight Wall Net – Ceremony Room",
    "price": 125.0,
    "group": "lights",
    "images": [
      "fairylight-wall-net-ceremony-room-1.jpg",
      "fairylight-wall-net-ceremony-room-2.jpg",
      "fairylight-wall-net-ceremony-room-3.jpg"
    ],
    "description": "Back wall of the ceremony room is covered in fairy lights\n\nAdds a soft, romantic touch to the room\n\nWarm lights\n\nCombine with zig zag lights across the ceiling for an additional £100\n\nReviews\n\nThere are no reviews yet.\n\nAdd a review\n\nBe the first to review “Fairylight Wall Net – Ceremony Room” Cancel reply\nYour Review\nName *\n\nEmail *\n\nSave my name, email, and website in this browser for the next time I comment."
  },
  {
    "slug": "fairy-light-globes",
    "name": "Stairwell Fairy Light Globes",
    "price": 105.0,
    "group": "lights",
    "images": [
      "fairy-light-globes-1.jpg",
      "fairy-light-globes-2.jpg",
      "fairy-light-globes-3.jpg"
    ],
    "description": "40 cm Globe Diameter\n\n240 warm white LEDs\n\nPrice is for six globes hanging down the stairwell and includes installation\n\nFor Hire at Sopley Mill only\n\nGlobes can be hire individually for other locations at the Mill for £20 per globe\n\nReviews\n\nThere are no reviews yet.\n\nAdd a review\n\nBe the first to review “Stairwell Fairy Light Globes” Cancel reply\nYour Review\nName *\n\nEmail *\n\nSave my name, email, and website in this browser for the next time I comment."
  },
  {
    "slug": "love-light-letters",
    "name": "Love light up letters",
    "price": 20.0,
    "group": "lights",
    "images": [
      "love-light-letters-1.jpg",
      "love-light-letters-2.jpg",
      "love-light-letters-3.jpg"
    ],
    "description": "Beautiful aluminium LOVE letters with inbuilt twinkly lights\n\nEach letter measures approx 25cm (h) by 21cm\n\nBattery powered so no plug needed (batteries provided)\n\nLook fab set up on windowsills or head table\n\nHire with my stepladder and use them to cascade down the ladder\n\n£20 to hire for the day or £15 if hired with a Garden Games package\n\nTwo available"
  },
  {
    "slug": "large-heart-light",
    "name": "Large Heart Light",
    "price": 30.0,
    "group": "lights",
    "images": [
      "large-heart-light-1.jpg"
    ],
    "description": "Handmade steel heart light\n\nLooks stunning in the evening or during the day\n\nInside use only and requires a plug\n\nIncluded in the downstairs floor set-up\n\n£30 to hire for the day Only one available Cost to buy / replace £230"
  },
  {
    "slug": "firepit",
    "name": "Firepit",
    "price": 100.0,
    "group": "outdoor",
    "images": [
      "firepit-1.jpg",
      "firepit-2.jpg",
      "firepit-3.jpg",
      "firepit-4.jpg"
    ],
    "description": "This stunning sculptural firepit ball makes a unique statement to add drama and warmth to the outside of the Mill. The beautiful African Safari scene is hand carved around the ball which comes alive when lit. Measuring almost a metre in diameter it is a large striking statement that encourages people to gather around it.\n\n£100 to hire for the duration of your wedding / event\n\nFirewood not included."
  },
  {
    "slug": "hay-bales",
    "name": "Hay Bales",
    "price": 10.0,
    "group": "outdoor",
    "images": [
      "hay-bales-1.jpg",
      "hay-bales-2.jpg",
      "hay-bales-3.jpg",
      "hay-bales-4.jpg"
    ],
    "description": "We offer Hay Bale Hire for weddings at Sopley Mill (and other wedding venues on request). Hay Bales are a great way to create additional outdoor seating. They are an ideal height for seating – use them on their own for a very natural, country look or drape them with material and add cushions to form stylish country seating. If you decide to eat outside you can use them as seating for the tables or be creative and build them up to form a Hay Sofa! Hay Bales are placed on the lawn on the morning of your wedding and can be left out over night, we will clear them away the following morning.\n\nHaybale hire cost: £10.00 per bale\n\nBlankets: We offer the hire of blankets at an additional cost of £50 for 10 blankets or £25 for 5 blankets (please enquire for the colours I have available).\n\nHaybale Package: Includes 10 hay bales, blankets, 2 cushions, a table, 2 potted flower pots (in season flowers such as daffodils (spring) lavender (summer), 2 Lanterns and and set up into haybale furniture for £160\n\nReviews\n\nThere are no reviews yet.\n\nAdd a review\n\nBe the first to review “Hay Bales” Cancel reply\nYour Review\nName *\n\nEmail *\n\nSave my name, email, and website in this browser for the next time I comment."
  },
  {
    "slug": "extralargepottedolivetrees",
    "name": "Large Potted Olive Trees",
    "price": 30.0,
    "group": "outdoor",
    "images": [
      "extralargepottedolivetrees-1.jpg"
    ],
    "description": "Large Olive Trees\n\nCan be displayed inside or out\n\nLook great at the end of aisle\n\nThese are potted in plastic pot but price includes for them to be put into large dark grey pot.\n\n£30 for one to hire for the day or £60 for the pair Two available Cost to buy / replace £90 per tree"
  },
  {
    "slug": "small-potted-olive-trees",
    "name": "Medium Potted Olive Trees",
    "price": 15.0,
    "group": "outdoor",
    "images": [
      "small-potted-olive-trees-1.jpg",
      "small-potted-olive-trees-2.jpg"
    ],
    "description": "Medium Potted Olive Trees\n\nCan be displayed inside or out\n\nThese are potted in vintage zinc buckets\n\n£15 for one to hire for the day or £30 for the pair Two available Cost to buy / replace £90 per tree"
  },
  {
    "slug": "full-set-of-all-8-garden-games",
    "name": "Full set of all 8 Garden Games",
    "price": 125.0,
    "group": "games",
    "images": [
      "full-set-of-all-8-garden-games-1.jpg",
      "full-set-of-all-8-garden-games-2.jpg"
    ],
    "description": "£125 or £150 for both Giant Chess and Giant Cornhole\n\nGiant Chess or Giant Cornhole\n\nGiant Jenga\n\nGiant Connect 4\n\nGiant Noughts & Crosses\n\nGiant Dominoes\n\nGiant Pick Up Sticks\n\nGiant Limbo\n\nQuoits\n\nFor Games Hire packages away from Sopley Mill, the games need to be collected and returned to Sopley Mill. SOPLEY MILL WEDDINGS ONLY Full set of all 8 Garden Games: £125 Price includes all as above. Games will be set out at Sopley Mill and collected from Sopley Mill early in the evening (we will try and do this while your guests are having their wedding breakfast). Games can be cancelled for a full refund as long as 24 hours notice is given – this should give you time to get a fairly accurate idea of the weather."
  },
  {
    "slug": "set-of-4-garden-games",
    "name": "Set of any 4 Garden Games including Giant Chess",
    "price": 100.0,
    "group": "games",
    "images": [
      "set-of-4-garden-games-1.jpg",
      "set-of-4-garden-games-2.jpg"
    ],
    "description": "Set of 4 Garden Games to include Giant Chess and your choice of remaining three games: £100\n\nPrice includes Delivery, Set up and Installation at Sopley Mill\n\nGiant Chess and your choice of remaining games ( Giant Jenga, Giant Connect 4, Giant Noughts & Crosses, Giant Dominoes, Giant Pick Up Sticks, Limbo and Quoits.)\n\nGames can be hired for other locations but must be collected and returned to Sopley Mill. If availability allows games can be collected the day before your wedding / event and returned the day after."
  },
  {
    "slug": "set-of-4-garden-games-not-including-giant-chess",
    "name": "Set of any 4 Garden Games NOT including Giant Chess",
    "price": 75.0,
    "group": "games",
    "images": [
      "set-of-4-garden-games-not-including-giant-chess-1.jpg",
      "set-of-4-garden-games-not-including-giant-chess-2.jpg",
      "set-of-4-garden-games-not-including-giant-chess-3.jpg",
      "set-of-4-garden-games-not-including-giant-chess-4.jpg"
    ],
    "description": "£75 Price includes Delivery, Set up and Installation at Sopley Mill\n\nAny four games EXCEPT Giant Chess ( Giant Jenga, Giant Connect 4, Giant Noughts & Crosses, Giant Dominoes, Giant Pick Up Sticks, Limbo and Quoits.)\n\nGames can be hired for other locations but must be collected and returned to Sopley Mill. If availability allows games can be collected the day before your wedding / event and returned the day after."
  },
  {
    "slug": "giant-cornhole",
    "name": "Giant Cornhole",
    "price": 40.0,
    "group": "games",
    "images": [
      "giant-cornhole-1.jpg",
      "giant-cornhole-2.jpg"
    ],
    "description": "Or included in the hire of various games packages\n\nA great fun, easy to play game for all ages\n\nIncludes 2 x regulation size boards – 120 x 60 cm with a 6 inch target hole.\n\nIncludes 8 (4 of each set of) professional corn hole bags"
  },
  {
    "slug": "kids-play-tent",
    "name": "Kids Play Tent",
    "price": 30.0,
    "group": "games",
    "images": [
      "kids-play-tent-1.jpg"
    ],
    "description": "Makes a great den for children – can be used inside or out\n\nFits three small children in with ease and more at a squash!\n\nIntegral base with ties and window with flap\n\n£30 to hire for the day or two for £50 Two available (this one and a different pattern for the second one) Cost to buy / replace £85"
  },
  {
    "slug": "wooden-arch",
    "name": "Wooden Arch",
    "price": 165.0,
    "group": "props",
    "images": [
      "wooden-arch-1.jpg",
      "wooden-arch-2.jpg",
      "wooden-arch-3.jpg",
      "wooden-arch-4.jpg"
    ],
    "description": "Rustic wooden arch, great for outdoor ceremonies, can also be used inside.\n\nRustic Wooden Arch\n\nComes with ivory / white material\n\nAdditional fresh greenery added for £75\n\nFlowers can be added for an additional cost"
  },
  {
    "slug": "cast-iron-red-post-box",
    "name": "Cast Iron Red Post Box",
    "price": 40.0,
    "group": "props",
    "images": [
      "cast-iron-red-post-box-1.jpg",
      "cast-iron-red-post-box-2.jpg"
    ],
    "description": "Cast Iron ER Royal Mail Pillar Red Post Box\n\nComplete with display card and key if required\n\nA stylish and secure way to receive your cards and money gifts\n\n£40 to hire for the day\n\n£35 to hire for the day if booked with any other Incabella Hire Items\n\nOnly one available\n\nCost to buy / replace £200"
  },
  {
    "slug": "woodenpostbox",
    "name": "Wooden Post Box",
    "price": 20.0,
    "group": "props",
    "images": [
      "woodenpostbox-1.jpg"
    ],
    "description": "Wooden / Metal Post Box\n\nRustic style\n\nLooks great on table surrounded by t-lights and lanterns\n\nGreat way to receive your cards and gifts\n\n£20 to hire for the day Only one available Cost to buy / replace £50"
  },
  {
    "slug": "large-vintage-milk-churn",
    "name": "Large Vintage Milk Churn",
    "price": 25.0,
    "group": "props",
    "images": [
      "large-vintage-milk-churn-1.jpg",
      "large-vintage-milk-churn-2.jpg"
    ],
    "description": "10 Gallon Aluminium Vintage Milk Churn\n\nLooks fantastic with large floral display\n\nGreat at the end of the aisle or either side of the door\n\nGet your florist to provide a flower display or for a less expensive option fill with flowering branches\n\n£25 to hire for the day\n\n£45 for two\n\nTwo available\n\nCost to replace £90"
  },
  {
    "slug": "medium-vintage-milk-churn",
    "name": "Medium Vintage Milk Churn",
    "price": 20.0,
    "group": "props",
    "images": [
      "medium-vintage-milk-churn-1.jpg"
    ],
    "description": "Aluminium Vintage Milk Churn\n\nApprox 50cm high\n\nLooks fantastic with floral display\n\nGreat at the end of the aisle or either side of the door\n\nIncabella is happy to do a flower display for an additional charge please enquire for details\n\nOr fill yourself with flowering branches\n\n£20 to hire for the day £35 for two Two available Cost to replace £60"
  },
  {
    "slug": "small-vintagemilkchurn",
    "name": "Small Vintage Milk Churn",
    "price": 15.0,
    "group": "props",
    "images": [
      "small-vintagemilkchurn-1.jpg"
    ],
    "description": "Small Vintage Milk Churn\n\nLooks fantastic with floral display or potted flowers in it\n\nGreat for either side of a door or the aisle\n\nPrice for milk churn only £15 to hire for the day £25 for two Two available Cost to replace £35\n\nMilk churn with flower arrangement £80 for one £150 for two"
  },
  {
    "slug": "vintageapplecrates",
    "name": "Vintage Apple Crates",
    "price": 5.0,
    "group": "props",
    "images": [
      "vintageapplecrates-1.jpg",
      "vintageapplecrates-2.jpg",
      "vintageapplecrates-3.jpg"
    ],
    "description": "Vintage Wooden Crates – various sizes\n\nIdeal for displaying potted flowers and lanterns\n\nAlso available with potted flower hire – just ask for details\n\nUse as side tables with haybales\n\n£5 to hire one\n\nFive available – mixed large and small\n\nCost to buy / replace £15"
  },
  {
    "slug": "two-vintage-suitcases",
    "name": "Two Vintage Suitcases",
    "price": 15.0,
    "group": "props",
    "images": [
      "two-vintage-suitcases-1.jpg"
    ],
    "description": "Two Vintage suitcases\n\nDark tan colour\n\nUse as a quirky table or an alternative to a post box\n\nAlso available as part of the Haybale package – see Haybales\n\n2 for £15\n\n1 for £10\n\nTrunk and Suitcase package available for £30\n\n2 Available\n\nCost to buy / replace £35 per suitcase"
  },
  {
    "slug": "vintagetrunk",
    "name": "Vintage Trunk",
    "price": 20.0,
    "group": "props",
    "images": [
      "vintagetrunk-1.jpg",
      "vintagetrunk-2.jpg"
    ],
    "description": "Large vintage trunk\n\nUse as a quirky table\n\nAlso available as part of the Haybale package – see Haybales\n\nSize\n\n1 for £20\n\nTrunk and Suitcase package available for £30\n\n1 Available\n\nCost to buy / replace £60 per lantern"
  },
  {
    "slug": "wooden-display-step-ladder",
    "name": "Wooden display step ladder",
    "price": 20.0,
    "group": "props",
    "images": [
      "wooden-display-step-ladder-1.jpg",
      "wooden-display-step-ladder-2.jpg",
      "wooden-display-step-ladder-3.jpg"
    ],
    "description": "Wooden step ladder painted in Farrow and Ball\n\nUse inside or out\n\nGreat for displaying flowers / tea lights / cupcakes\n\n£20 to hire for the day\n\nOnly one available\n\nCost to buy / replace £90"
  },
  {
    "slug": "displayblackboard",
    "name": "Rustic Display Blackboard",
    "price": 15.0,
    "group": "props",
    "images": [
      "displayblackboard-1.jpg"
    ],
    "description": "Rustic wooden framed hinged blackboard\n\nDouble sided (can write on both sides)\n\nVintage wooden frame in a light khaki green\n\nHeight 98cm, width 46cm\n\n£15 to hire for the day\n\nOnly one available\n\nCost to buy / replace £50"
  },
  {
    "slug": "bunting",
    "name": "Country Bunting – 25 Metres",
    "price": 25.0,
    "group": "props",
    "images": [
      "bunting-1.jpg"
    ],
    "description": "25 metres of 100% Cotton English Country Bunting\n\nCombination of checked and striped fabrics on a white cotton line\n\nConsists of 84 Flags (each flat is 19 x 20cm)\n\nDouble-sided (two pieces of fabric sewn together)\n\nCan be used inside or outside\n\nLooks fantastic tied to the trees stretching across the lawn\n\n£25 to hire for the day\n\nOnly one currently available but please request if you would like more)\n\nCost to buy / replace £59"
  },
  {
    "slug": "10-x-antique-brass-table-numbers",
    "name": "10 x Antique Brass Table Numbers",
    "price": 30.0,
    "group": "props",
    "images": [
      "10-x-antique-brass-table-numbers-1.jpg",
      "10-x-antique-brass-table-numbers-2.jpg",
      "10-x-antique-brass-table-numbers-3.jpg",
      "10-x-antique-brass-table-numbers-4.jpg"
    ],
    "description": "Antique Brass table number picture frame\n\nIncludes printed table number insert as in image for numbers 1-9 and Top Table or numbers 1-10\n\nPersonalised table names possible for a an additional cost\n\nOr print your own table names to put inside instead – takes image size 7×5\n\n£30 for ten antique brass frames with insert. 10 available\n\nCost to buy / replace £20 per frame"
  },
  {
    "slug": "log-slices",
    "name": "10 x Log Slices",
    "price": 30.0,
    "group": "props",
    "images": [
      "log-slices-1.jpg"
    ],
    "description": "Rustic wooden log slices\n\nVarious widths / sizes available\n\nAll slightly different so please do ask to see them\n\n£30 for 10 Large Slices\n\n£45 for 10 Large and 10 Small Log Slices\n\nOnly one available\n\nCost to buy / replace £50"
  },
  {
    "slug": "round-mirror-plate-table-centre-piece",
    "name": "Round mirror plates – table centre pieces",
    "price": 2.95,
    "group": "props",
    "images": [
      "round-mirror-plate-table-centre-piece-1.jpg"
    ],
    "description": "Round Mirror Plate – 40cm\n\nGreat table centre piece\n\nDecorate with vases / pots of flowers and tea lights\n\nBevelled Edge\n\n£2.95 per mirror\n\n10 for £25\n\n10 Available\n\nCost to buy / replace £11.35 per mirror"
  },
  {
    "slug": "sweetjars",
    "name": "Sweet Jars",
    "price": 4.0,
    "group": "props",
    "images": [
      "sweetjars-1.jpg"
    ],
    "description": "Make your own sweet cart using these fab vintage sweet jars\n\nFill each one with a different type of sweet\n\nHeight 30cm\n\nMade from Glass\n\nTo Hire: £4.00 per Jar\n\nOr 4 for £15\n\n8 Available\n\nCost to buy / replace £15.95 per jar"
  },
  {
    "slug": "tall-glass-dinner-candle-holder",
    "name": "Tall Glass Dinner Candle Holder",
    "price": 4.0,
    "group": "lanterns",
    "images": [
      "tall-glass-dinner-candle-holder-1.jpg",
      "tall-glass-dinner-candle-holder-2.jpg"
    ],
    "description": "Allows you to have tall, elegant dinner candles\n\nMakes lovely table centre pieces – particularly for long tables\n\nEnclosed flame means suitable for indoor use\n\nEach glass holder is 30cm tall, diameter 7cm\n\nIvory dinner candle included\n\nPlease be aware the glass does get very hot when candles have been lit for a long time so keep out of reach of children\n\nTo Hire: £4 per glass holder\n\nPackages also available"
  },
  {
    "slug": "rustic-brass-votive",
    "name": "Rustic Brass Votive",
    "price": 2.5,
    "group": "lanterns",
    "images": [
      "rustic-brass-votive-1.jpg"
    ],
    "description": "Rustic brass votive\n\nLattice effect\n\n9.5cm x 7.5cm, tea light included\n\n10 for £20\n\n12 Available Cost to buy / replace £10 per votive"
  },
  {
    "slug": "sana-storm-lantern-small",
    "name": "Sana Storm Lantern – Small",
    "price": 6.95,
    "group": "lanterns",
    "images": [
      "sana-storm-lantern-small-1.jpg"
    ],
    "description": "Stylish grey steel and glass lanterns\n\nEnclosed Candle means can be used inside and out\n\nLook stunning lining your aisle or as table centre piece\n\nUse outside to add atmosphere to a terrace or bridge\n\nDecorate bottom with rose petals or similar\n\nSize 25 x 15 x 15cm\n\nPillar Candle Included (may not be new but with plenty of burn time left)\n\nTo Hire: £6.95 per Lantern\n\n£40 for six lanterns\n\n£50 for eight lanterns\n\n8 Available\n\nCost to buy / replace £29.95 per lantern"
  },
  {
    "slug": "swedish-lantern",
    "name": "Swedish Lantern",
    "price": 10.0,
    "group": "lanterns",
    "images": [
      "swedish-lantern-1.jpg",
      "swedish-lantern-2.jpg"
    ],
    "description": "Beautiful, antique grey metal lantern.\n\nEnclosed flame means suitable for indoor use\n\nEach lantern is 15 x 37 cm\n\nPillar Candle Included (may not be new but with plenty of burn time left)\n\nTo Hire: £1o.oo per lantern\n\n2 Available\n\nCost to buy / replace £36.50 per lantern"
  },
  {
    "slug": "silver-lantern",
    "name": "Silver Lantern",
    "price": 7.95,
    "group": "lanterns",
    "images": [
      "silver-lantern-1.jpg",
      "silver-lantern-2.jpg"
    ],
    "description": "Look great outside on summer evenings, lining a bridge or dotted around a terrace\n\nGreat quality lanterns give of soft, flickering, romantic light\n\nEnclosed flame means suitable for indoor use, look stunning lining the wedding aisle\n\nEach lantern is 42cm x 15cm x 16cm (not including the handle)\n\nPillar Candle Included (may not be new but with plenty of burn time left)\n\nTo Hire: £7.95 per Lantern\n\n£45 for six lanterns\n\n£55 for eight lanterns\n\n8 Available\n\nCost to buy / replace £39.50 per lantern"
  },
  {
    "slug": "outdoor-led-hurricane-lantern",
    "name": "Outdoor LED Hurricane Lantern",
    "price": 6.0,
    "group": "lanterns",
    "images": [
      "outdoor-led-hurricane-lantern-1.jpg",
      "outdoor-led-hurricane-lantern-2.jpg"
    ],
    "description": "Beautiful, antique grey metal lantern.\n\nBattery powered and equipped with a bulb\n\nGreat outdoor lighting for tables / lining a pathway or to be hung up\n\nPerfect for adding a warm glow to any setting\n\nEach lantern is 19 x 15.5 x 30 cm\n\nTo Hire: £6.oo per lantern including batteries. Set of 10 for £50\n\n12 Available\n\nCost to buy / replace £36.50 per lantern"
  },
  {
    "slug": "large-white-washed-lantern",
    "name": "Large white washed lantern",
    "price": 15.0,
    "group": "lanterns",
    "images": [
      "large-white-washed-lantern-1.jpg",
      "large-white-washed-lantern-2.jpg"
    ],
    "description": "Large White Washed Wooden Lanterns\n\nEnclosed candle means can be used inside and out\n\nPerfect for framing door ways or the start of the aisle\n\nSize Height approx 80cm, Width approx 28cm\n\n1 Pillar Candles Included (may not be new but with plenty of burn time left)\n\nAlso offered as part of my ceremony room set-up package\n\n2 for £30 2 Available Cost to buy / replace £115 per lantern"
  },
  {
    "slug": "rope-lantern",
    "name": "Rope Lantern",
    "price": 8.95,
    "group": "lanterns",
    "images": [
      "rope-lantern-1.jpg",
      "rope-lantern-2.jpg"
    ],
    "description": "Looks stunning either side of venue entrance\n\nGreat for inside or out\n\nEnclosed flame means suitable for indoor use\n\nEach lantern is 25cm x 18cm\n\nTo Hire: £8.95 per Lantern\n\nOr two for £15 2 Available\n\nCost to buy / replace £35 per lantern"
  },
  {
    "slug": "gold-rim-glass-t-light-small",
    "name": "Gold Rim Glass T-Light – Small",
    "price": 1.5,
    "group": "lanterns",
    "images": [
      "gold-rim-glass-t-light-small-1.jpg"
    ],
    "description": "Glass Tea light holder with gold rim\n\nGives of lovely sparkling light\n\nElegant and sophisticated\n\nIdeal dotted around on each table\n\n7cm x 6cm, tea light included\n\n40 for £45\n\n40 Available Cost to buy / replace £6.95 per lantern"
  },
  {
    "slug": "hanging-tea-light",
    "name": "Hanging Tea Light",
    "price": 7.5,
    "group": "lanterns",
    "images": [
      "hanging-tea-light-1.jpg"
    ],
    "description": "Sweet Tea Light holders ideal for hanging in trees\n\nPretty bells around rim\n\nEach holder is 6cm x 8cm\n\nTealight not included\n\n10 for £7.50\n\n20 for £10.50\n\n20 Available\n\nCost to buy / replace £2.95 per lantern"
  },
  {
    "slug": "passu-hanging-tea-light",
    "name": "Passu Hanging Tea Light",
    "price": 17.5,
    "group": "lanterns",
    "images": [
      "passu-hanging-tea-light-1.jpg",
      "passu-hanging-tea-light-2.jpg",
      "passu-hanging-tea-light-3.jpg",
      "passu-hanging-tea-light-4.jpg"
    ],
    "description": "Sweet Tea Light holders ideal for hanging in trees\n\nDistressed White\n\nEach holder is 11cm (H) x 8cm (Dia)\n\nTakes standard t-light\n\nGives out beautifully twinkly light\n\n10 for £17.501 16 Available Cost to buy / replace £9.95 per lantern"
  },
  {
    "slug": "clear-glass-hurricane-vase",
    "name": "Clear Glass Hurricane Vase",
    "price": 6.0,
    "group": "lanterns",
    "images": [
      "clear-glass-hurricane-vase-1.jpg",
      "clear-glass-hurricane-vase-2.jpg"
    ],
    "description": "Look great with pillar candles in them\n\nUse to line the aisle or as table centre pieces\n\nAdd some pretty decoration around the bottom such as pinecones or dried roses\n\nSize 27cm x 16.5cm\n\nCandle included (may be partially used)\n\nCan also be hired as part of a ceremony room set-up, please ask for details\n\nTo Hire: £6 per Lantern\n\nOr 8 for £45\n\n10 for £55\n\n10 Available\n\nCost to buy / replace £19.95 per lantern."
  },
  {
    "slug": "moroccanlantern",
    "name": "Moroccan Lantern",
    "price": 15.0,
    "group": "lanterns",
    "images": [
      "moroccanlantern-1.jpg"
    ],
    "description": "Lovely Moroccan Lantern\n\nAntique finish with pretty pale blue markings on it\n\nLooks great against red brick work\n\nApprox Size Height 58cm, Width 29cm,\n\n1 Pillar Candles Included (may not be new but with plenty of burn time left)\n\n1 for £15\n\n2 Available\n\nCost to buy / replace £89.95 per lantern"
  },
  {
    "slug": "tall-cylinder-glass-vases",
    "name": "Tall Cylinder Glass Vases",
    "price": 2.5,
    "group": "lanterns",
    "images": [
      "tall-cylinder-glass-vases-1.jpg"
    ],
    "description": "Tall Cylinder Glass Vase\n\nThey look fantastic with candles, floating candles or fairylights inside\n\nLook great lining the aisle or as table centre pieces\n\nVarious heights available, price from £2.50 per vase depending on size,\n\nSee also as table centre piece package and ceremony room package."
  },
  {
    "slug": "ndiki-lantern",
    "name": "Ndiki Lantern",
    "price": 17.5,
    "group": "lanterns",
    "images": [
      "ndiki-lantern-1.jpg",
      "ndiki-lantern-2.jpg"
    ],
    "description": "Beautiful tall antique brass lantern.\n\nEnclosed flame means suitable for indoor use\n\nEach lantern is 41 x 20 x 20cm\n\nPillar Candle Included (may not be new but with plenty of burn time left)\n\nTo Hire: £17.50 per lantern\n\n2 Available\n\nCost to buy / replace £65 per lantern"
  },
  {
    "slug": "sparkling-silver-t-light-small",
    "name": "Sparkling Silver T-Light – Small",
    "price": 10.0,
    "group": "lanterns",
    "images": [
      "sparkling-silver-t-light-small-1.jpg"
    ],
    "description": "A gorgeous T-light holder that really does sparkle\n\nRustic Silver Glass with pretty flower patternIdeal dotted around on each table\n\nMix and Match with the large ones\n\n7cm High, tea light included\n\n10 for £10\n\n20 for £18.50\n\n40 for £35\n\n20 Small, 20 Large £40\n\n40 Available\n\nCost to buy / replace £4.95 per lantern"
  },
  {
    "slug": "extralargesilverlantern",
    "name": "Extra Large Silver Lantern",
    "price": 15.0,
    "group": "lanterns",
    "images": [
      "extralargesilverlantern-1.jpg",
      "extralargesilverlantern-2.jpg"
    ],
    "description": "Very Large Stylish Silver Lanterns\n\nEnclosed Candle means can be used inside and out\n\nPerfect for framing door ways or the start of the aisle\n\nLooks great with group of three candles\n\nDecorate bottom with rose petals or similar\n\nSize Height 59cm, Width 30cm, Depth 31cm\n\n3 Pillar Candles Included (may not be new but with plenty of burn time left)\n\n2 for £30\n\n2 Available\n\nCost to buy / replace £89.95 per lantern"
  },
  {
    "slug": "hanging-heart-tea-light",
    "name": "Hanging Heart Tea Light",
    "price": 7.5,
    "group": "lanterns",
    "images": [
      "hanging-heart-tea-light-1.jpg"
    ],
    "description": "Sweet Tea Light holders ideal for hanging in trees\n\nPretty bells around rim\n\nEach holder is 6cm x 8cm\n\nTealight not included\n\n10 for £7.50\n\n20 for £10.50\n\n20 Available\n\nCost to buy / replace £2.95 per lantern"
  },
  {
    "slug": "mohani-lantern",
    "name": "Mohani Lantern",
    "price": 10.5,
    "group": "lanterns",
    "images": [
      "mohani-lantern-1.jpg",
      "mohani-lantern-2.jpg"
    ],
    "description": "Stunning asymmetric design antique brass lantern.\n\nMakes lovely table centre piece\n\nEnclosed flame means suitable for indoor use, look stunning lining the wedding aisle\n\nEach lantern is 26 x 16cm\n\nPillar Candle Included (may not be new but with plenty of burn time left)\n\nLook great outside on summer evenings, lining a bridge or dotted around a terrace\n\nTo Hire: £10.50 per lantern\n\n£95 for ten lanterns, 12 Available\n\nCost to buy / replace £45 per lantern"
  },
  {
    "slug": "sparkling-silver-t-light-large",
    "name": "Sparkling Silver T-Light – Large",
    "price": 1.5,
    "group": "lanterns",
    "images": [
      "sparkling-silver-t-light-large-1.jpg",
      "sparkling-silver-t-light-large-2.jpg"
    ],
    "description": "A gorgeous T-light holder that really does sparkle\n\nRustic Silver Glass with pretty flower pattern\n\nIdeal dotted around on each table\n\nMix and Match with the small ones\n\n9cm High, tea light included\n\n10 for £15\n\n20 for £25\n\n40 for £40\n\n20 Small, 20 Large £40\n\n40 Available\n\nCost to buy / replace £6.95 per lantern"
  }
];
