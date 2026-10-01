/*
  IncaBella hire collection: the one file to edit for products and prices.

  Each product:
    slug         short web name, used in links (letters, numbers and dashes only)
    name         shown on the site
    price        in pounds, a plain number (1000 not "£1,000.00")
    unit         optional, shown after the price, e.g. "per table", "per 10", "each"
    from         optional, true shows "From £…" for packages that vary
    group        one of the group ids in INCABELLA_GROUPS below
    images       file names in assets/img/products/ (the first one is the main photo)
    description  shown on the product page; a blank line starts a new paragraph,
                 lines starting "- " become a bulleted list
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
    "blurb": "Lanterns, tealights and vases for tables, aisles and trees."
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
    "from": true,
    "group": "packages",
    "images": [
      "full-decoration-package-silver-1.jpg",
      "full-decoration-package-silver-2.jpg",
      "full-decoration-package-silver-3.jpg",
      "full-decoration-package-silver-4.jpg"
    ],
    "description": "Take the stress out of doing it yourself and let IncaBella decorate all three floors of the Mill.\n\nGround floor\n- The river window display\n- Your choice of post box\n- Lots of lanterns, tealights, crates and potted flowers\n\nCeremony room\n- Each corner of the stage: a large white wooden lantern on a crate, with at least five tall glass vases or hurricane lanterns, all with candles and fresh greenery\n- Down the aisle: a Mohani lantern or large glass hurricane lamp on a log slice at the end of every other row\n- Prefer an outdoor ceremony? Add £50\n\nTables\n- Lucy moves your aisle ends up to become your table centre pieces, with a table number frame and tealights on each table\n- Based on 8–10 round tables, or 8 round tables and a top table two tables long\n\nOptional extras at additional cost: greenery garlands, chair sashes, fairy lights, garden games, the firepit, extra flowers, bouquets and buttonholes."
  },
  {
    "slug": "full-decoration-package-tier-2",
    "name": "Full Decoration Package – Tier 2",
    "price": 1000.0,
    "from": true,
    "group": "packages",
    "images": [
      "full-decoration-package-tier-2-1.jpg",
      "full-decoration-package-tier-2-2.jpg",
      "full-decoration-package-tier-2-3.jpg"
    ],
    "description": "Everything in Tier 1, plus fairy lights, chair sashes and a greenery runner. IncaBella decorates all three floors of the Mill.\n\nGround floor\n- The river window display\n- Your choice of post box\n- Lots of lanterns, tealights, crates and potted flowers\n\nCeremony room\n- Each corner of the stage: a large white wooden lantern on a crate, with at least five tall glass vases or hurricane lanterns, all with candles and fresh greenery\n- Down the aisle: a Mohani lantern or large glass hurricane lamp on a log slice at the end of every other row, and a white sash on each aisle-end chair\n- A net of fairy lights along the back wall and fairy lights zig-zagged across the ceiling\n\nTables\n- Lucy moves your aisle ends up to become your table centre pieces, with a table number frame and tealights on each table\n- A greenery runner along the top table\n- Based on 8–10 round tables, or 8 round tables and a top table two tables long\n\nOptional extras at additional cost: greenery garlands, aisle runner, wooden arch, garden games, the firepit, extra flowers, bouquets and buttonholes."
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
    "description": "Let IncaBella make the ground floor of Sopley Mill look wonderful.\n\n- The river window display (usually £95 on its own)\n- Your choice of post box, set up with flowers and tealights\n- The large heart light\n- A Moroccan lantern\n- Lots more lanterns and tealights\n- Potted flowers and small potted trees such as olives\n\nSet up on the morning of your wedding. Talk to Lucy about which flowers will be in season for your date, or about any colour scheme you have in mind."
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
    "description": "A beautiful, rustic dressing for an outdoor ceremony.\n\n- Each corner by the signing table decorated with crates, cut logs, lanterns and potted flowers\n- A mix of potted flowers and lanterns at each bench end down the aisle\n- Two large potted olive trees\n\nAdd the wooden arch with billowing white fabric for £165.\n\nSet up on the morning of your wedding and tailored to you, for example swapping one lantern style for another. Exact potted flowers depend on what's growing at the time.\n\nOnce it's set up outside it can't be moved in if the weather changes. Lucy can set it up inside instead if you let her know by the evening before."
  },
  {
    "slug": "ceremonyroomset-up",
    "name": "Ceremony Room Set-Up",
    "price": 195.0,
    "group": "packages",
    "images": [
      "ceremonyroomset-up-1.jpg"
    ],
    "description": "A beautiful, rustic way to make the ceremony room look and smell lovely.\n\n- Each corner of the stage: a large white wooden lantern on a crate, with at least five tall glass vases or hurricane lanterns, all with candles\n- Down the aisle: a Mohani lantern or large glass hurricane lamp on a log slice at the end of every other row\n\nAdd-ons\n- Lots of fresh greenery: £80\n- Two small milk churns with flower arrangements: £135\n- Ivory chair sashes, 20 for £50\n- Fairy lights, aisle runners and extra flowers: ask Lucy for prices\n\nSet up on the morning of your wedding and tailored to you, for example swapping one lantern style for another."
  },
  {
    "slug": "riverwindowsetup",
    "name": "River Window Set-Up",
    "price": 95.0,
    "group": "packages",
    "images": [
      "riverwindowsetup-1.jpg",
      "riverwindowsetup-2.jpg"
    ],
    "description": "Let IncaBella dress the alcove in the Mill's river window.\n\n- Seasonal potted plants and an olive tree\n- Crates and small LOVE letters\n- A large selection of tealights and lanterns\n\nSet up on the morning of your wedding. Talk to Lucy about which flowers will be in season for your date, or about any colour scheme you have in mind."
  },
  {
    "slug": "apple-crate-set-up",
    "name": "Apple Crate Set-Up",
    "price": 95.0,
    "group": "packages",
    "images": [
      "apple-crate-set-up-1.jpg"
    ],
    "description": "A lovely welcome as your guests arrive.\n\n- Five vintage apple crates\n- A selection of lanterns and tealights\n- Potted flowers, plants and small posies\n- Set up outside or in\n\nSet up on the morning of your wedding. Talk to Lucy about which flowers will be in season for your date, or about any colour scheme you have in mind."
  },
  {
    "slug": "table-centre-piece-package",
    "name": "Mohani Lantern Table Centre Piece",
    "price": 25.0,
    "unit": "per table",
    "group": "packages",
    "images": [
      "table-centre-piece-package-1.jpg",
      "table-centre-piece-package-2.jpg",
      "table-centre-piece-package-3.jpg"
    ],
    "description": "A table centre piece that fills the room with warmth.\n\n- An antique brass Mohani lantern with candle on a rustic wood slice\n- Fresh greenery\n- Five diamond glass tealights\n- A table number holder and card\n\nAdd three small vases of flowers for £15 per table. The lanterns and wood slices can also start the day as aisle ends and move up to the tables, for a small extra cost."
  },
  {
    "slug": "table-centre-piece-package-2",
    "name": "Glass Cylinder Table Centre Piece",
    "price": 30.0,
    "unit": "per table",
    "group": "packages",
    "images": [
      "table-centre-piece-package-2-1.jpg",
      "table-centre-piece-package-2-2.jpg",
      "table-centre-piece-package-2-3.jpg",
      "table-centre-piece-package-2-4.jpg"
    ],
    "description": "An elegant centre piece that works just as well as an aisle end.\n\n- Three glass cylinder vases of different heights, with pillar candles or floating candles\n- Fresh greenery\n- A table name or number frame\n\nOn the top table these look lovely set along the front edge. Real or LED candles are both options. The vases can start the day as aisle ends and move up to the tables, for a small extra cost. Chair drapes and other extras are also available."
  },
  {
    "slug": "table-centre-piece-long-table",
    "name": "Long Table Centre Piece",
    "price": 35.0,
    "unit": "per table",
    "group": "packages",
    "images": [
      "table-centre-piece-long-table-1.jpg",
      "table-centre-piece-long-table-2.jpg"
    ],
    "description": "Made for rustic long tables.\n\n- A greenery runner down the middle of the table\n- Tall clear glass lanterns and tealights along it"
  },
  {
    "slug": "ceiling-fairy-lights-ceremony-room",
    "name": "Ceiling Fairy Lights – Ceremony Room",
    "price": 125.0,
    "group": "lights",
    "images": [
      "ceiling-fairy-lights-ceremony-room-1.jpg"
    ],
    "description": "Warm white fairy lights zig-zagged across the ceremony room ceiling for a soft, romantic glow.\n\nAdd the fairy light wall net on the back wall for an extra £100."
  },
  {
    "slug": "fairylight-wall-net-ceremony-room",
    "name": "Fairy Light Wall Net – Ceremony Room",
    "price": 125.0,
    "group": "lights",
    "images": [
      "fairylight-wall-net-ceremony-room-1.jpg",
      "fairylight-wall-net-ceremony-room-2.jpg",
      "fairylight-wall-net-ceremony-room-3.jpg"
    ],
    "description": "The back wall of the ceremony room covered in warm white fairy lights for a soft, romantic glow.\n\nAdd the zig-zag ceiling lights for an extra £100."
  },
  {
    "slug": "fairy-light-globes",
    "name": "Stairwell Fairy Light Globes",
    "price": 105.0,
    "unit": "for six, fitted",
    "group": "lights",
    "images": [
      "fairy-light-globes-1.jpg",
      "fairy-light-globes-2.jpg",
      "fairy-light-globes-3.jpg"
    ],
    "description": "Six glowing globes hanging down the Mill's stairwell.\n\n- 40cm diameter, 240 warm white LEDs each\n- Price includes installation\n- Single globes for elsewhere in the Mill: £20 each"
  },
  {
    "slug": "love-light-letters",
    "name": "LOVE Light-Up Letters",
    "price": 20.0,
    "group": "lights",
    "images": [
      "love-light-letters-1.jpg",
      "love-light-letters-2.jpg",
      "love-light-letters-3.jpg"
    ],
    "description": "Aluminium LOVE letters with built-in twinkly lights.\n\n- Each letter about 25cm high and 21cm wide\n- Battery powered, batteries included\n- Lovely on a windowsill or the top table, or cascading down the step ladder\n- £15 when hired with a garden games package\n- Two sets available"
  },
  {
    "slug": "large-heart-light",
    "name": "Large Heart Light",
    "price": 30.0,
    "group": "lights",
    "images": [
      "large-heart-light-1.jpg"
    ],
    "description": "A handmade steel heart light that looks stunning day or night.\n\n- Indoor use only; needs a plug\n- Included in the Ground Floor Decoration Package\n- One available"
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
    "description": "A sculptural firepit ball with an African safari scene hand-cut around it that comes alive when lit. At almost a metre across, it adds drama and warmth outside the Mill and draws guests together.\n\n- Hire is for the whole of your wedding or event\n- Firewood not included"
  },
  {
    "slug": "hay-bales",
    "name": "Hay Bales",
    "price": 10.0,
    "unit": "per bale",
    "group": "outdoor",
    "images": [
      "hay-bales-1.jpg",
      "hay-bales-2.jpg",
      "hay-bales-3.jpg",
      "hay-bales-4.jpg"
    ],
    "description": "Extra outdoor seating at just the right height. Use them as they are for a natural country look, dress them with fabric and cushions, use them at outdoor tables, or stack them into a hay sofa.\n\nBales go out on the lawn on the morning of your wedding and can stay out overnight. They're cleared away the next morning.\n\n- Blankets: 5 for £25 or 10 for £50 (ask Lucy which colours are available)\n- Hay Bale Package, £160: 10 bales, blankets, 2 cushions, a table, 2 pots of seasonal flowers and 2 lanterns, set up as hay bale furniture"
  },
  {
    "slug": "extralargepottedolivetrees",
    "name": "Large Potted Olive Tree",
    "price": 30.0,
    "unit": "each",
    "group": "outdoor",
    "images": [
      "extralargepottedolivetrees-1.jpg"
    ],
    "description": "A large olive tree for inside or out. Lovely at the end of the aisle.\n\n- Displayed in a large dark grey pot\n- £60 for the pair; two available"
  },
  {
    "slug": "small-potted-olive-trees",
    "name": "Medium Potted Olive Tree",
    "price": 15.0,
    "unit": "each",
    "group": "outdoor",
    "images": [
      "small-potted-olive-trees-1.jpg",
      "small-potted-olive-trees-2.jpg"
    ],
    "description": "A medium olive tree in a vintage zinc bucket, for inside or out.\n\n- £30 for the pair; two available"
  },
  {
    "slug": "full-set-of-all-8-garden-games",
    "name": "All Eight Garden Games",
    "price": 125.0,
    "group": "games",
    "images": [
      "full-set-of-all-8-garden-games-1.jpg",
      "full-set-of-all-8-garden-games-2.jpg"
    ],
    "description": "The full set of giant garden games.\n\n- Giant chess or giant cornhole (£150 for both)\n- Giant Jenga\n- Giant Connect 4\n- Giant noughts and crosses\n- Giant dominoes\n- Giant pick-up sticks\n- Limbo\n- Quoits\n\nLucy sets the games out at the Mill and collects them early in the evening, usually during the wedding breakfast. Cancel up to 24 hours before for a full refund, so you can wait and see the weather forecast."
  },
  {
    "slug": "set-of-4-garden-games",
    "name": "Four Garden Games with Giant Chess",
    "price": 100.0,
    "unit": "per set",
    "group": "games",
    "images": [
      "set-of-4-garden-games-1.jpg",
      "set-of-4-garden-games-2.jpg"
    ],
    "description": "Giant chess plus three more games of your choice: giant Jenga, giant Connect 4, giant noughts and crosses, giant dominoes, giant pick-up sticks, limbo or quoits.\n\n- Delivery and set-up at Sopley Mill included\n- Can be hired for other venues if collected from and returned to the Mill, the day before and after where possible"
  },
  {
    "slug": "set-of-4-garden-games-not-including-giant-chess",
    "name": "Four Garden Games",
    "price": 75.0,
    "unit": "per set",
    "group": "games",
    "images": [
      "set-of-4-garden-games-not-including-giant-chess-1.jpg",
      "set-of-4-garden-games-not-including-giant-chess-2.jpg",
      "set-of-4-garden-games-not-including-giant-chess-3.jpg",
      "set-of-4-garden-games-not-including-giant-chess-4.jpg"
    ],
    "description": "Any four games except giant chess: giant Jenga, giant Connect 4, giant noughts and crosses, giant dominoes, giant pick-up sticks, limbo or quoits.\n\n- Delivery and set-up at Sopley Mill included\n- Can be hired for other venues if collected from and returned to the Mill, the day before and after where possible"
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
    "description": "An easy, fun game for all ages. Also included in some garden games sets.\n\n- Two regulation boards, 120 × 60cm, with a 6-inch hole\n- Eight professional cornhole bags"
  },
  {
    "slug": "kids-play-tent",
    "name": "Kids' Play Tent",
    "price": 30.0,
    "group": "games",
    "images": [
      "kids-play-tent-1.jpg"
    ],
    "description": "A den for little guests, inside or out. Fits three small children easily, and more at a squash.\n\n- Built-in base, ties and a window with a flap\n- Two for £50 (the second has a different pattern)"
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
    "description": "A rustic wooden arch dressed with ivory or white fabric. Beautiful for outdoor ceremonies and can be used inside too.\n\n- Add fresh greenery for £75\n- Flowers can be added at additional cost"
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
    "description": "A cast iron ER Royal Mail pillar box: a stylish, secure home for cards and gifts.\n\n- Comes with display card and key\n- £35 when booked with any other IncaBella hire\n- One available"
  },
  {
    "slug": "woodenpostbox",
    "name": "Wooden Post Box",
    "price": 20.0,
    "group": "props",
    "images": [
      "woodenpostbox-1.jpg"
    ],
    "description": "A rustic wood and metal post box for cards and gifts. Lovely on a table surrounded by tealights and lanterns.\n\n- One available"
  },
  {
    "slug": "large-vintage-milk-churn",
    "name": "Large Vintage Milk Churn",
    "price": 25.0,
    "unit": "each",
    "group": "props",
    "images": [
      "large-vintage-milk-churn-1.jpg",
      "large-vintage-milk-churn-2.jpg"
    ],
    "description": "A 10-gallon aluminium milk churn. Stunning with a large floral display, at the end of the aisle or either side of a door.\n\n- Fill with flowering branches for a less expensive option\n- £45 for two; two available"
  },
  {
    "slug": "medium-vintage-milk-churn",
    "name": "Medium Vintage Milk Churn",
    "price": 20.0,
    "unit": "each",
    "group": "props",
    "images": [
      "medium-vintage-milk-churn-1.jpg"
    ],
    "description": "An aluminium milk churn about 50cm tall. Lovely with flowers at the end of the aisle or either side of a door.\n\n- Lucy can add a flower display for an extra charge, or fill it yourself with flowering branches\n- £35 for two; two available"
  },
  {
    "slug": "small-vintagemilkchurn",
    "name": "Small Vintage Milk Churn",
    "price": 15.0,
    "unit": "each",
    "group": "props",
    "images": [
      "small-vintagemilkchurn-1.jpg"
    ],
    "description": "A small milk churn for flowers or potted plants, either side of a door or the aisle.\n\n- £25 for two; two available\n- With a flower arrangement: £80 each or £150 for two"
  },
  {
    "slug": "vintageapplecrates",
    "name": "Vintage Apple Crates",
    "price": 5.0,
    "unit": "each",
    "group": "props",
    "images": [
      "vintageapplecrates-1.jpg",
      "vintageapplecrates-2.jpg",
      "vintageapplecrates-3.jpg"
    ],
    "description": "Wooden crates in mixed sizes. Ideal for displaying potted flowers and lanterns, or as side tables with hay bales.\n\n- Can be hired with potted flowers; just ask\n- Five available, large and small"
  },
  {
    "slug": "two-vintage-suitcases",
    "name": "Two Vintage Suitcases",
    "price": 15.0,
    "unit": "for the pair",
    "group": "props",
    "images": [
      "two-vintage-suitcases-1.jpg"
    ],
    "description": "Two dark tan vintage suitcases. Use them as a quirky table or instead of a post box.\n\n- One suitcase: £10\n- Suitcases and trunk together: £30\n- Also part of the Hay Bale Package"
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
    "description": "A large vintage trunk to use as a quirky table.\n\n- Trunk and two suitcases together: £30\n- Also part of the Hay Bale Package\n- One available"
  },
  {
    "slug": "wooden-display-step-ladder",
    "name": "Wooden Display Step Ladder",
    "price": 20.0,
    "group": "props",
    "images": [
      "wooden-display-step-ladder-1.jpg",
      "wooden-display-step-ladder-2.jpg",
      "wooden-display-step-ladder-3.jpg"
    ],
    "description": "A wooden step ladder painted in Farrow & Ball, for inside or out. Great for displaying flowers, tealights or cupcakes.\n\n- One available"
  },
  {
    "slug": "displayblackboard",
    "name": "Rustic Display Blackboard",
    "price": 15.0,
    "group": "props",
    "images": [
      "displayblackboard-1.jpg"
    ],
    "description": "A hinged, double-sided blackboard in a vintage khaki-green wooden frame.\n\n- 98cm high, 46cm wide\n- One available"
  },
  {
    "slug": "bunting",
    "name": "Country Bunting",
    "price": 25.0,
    "unit": "25 metres",
    "group": "props",
    "images": [
      "bunting-1.jpg"
    ],
    "description": "25 metres of cotton English country bunting in checks and stripes on a white line. Lovely strung between the trees across the lawn.\n\n- 84 double-sided flags, each 19 × 20cm\n- Inside or out\n- Ask Lucy if you'd like more than one length"
  },
  {
    "slug": "10-x-antique-brass-table-numbers",
    "name": "Antique Brass Table Numbers",
    "price": 30.0,
    "unit": "set of 10",
    "group": "props",
    "images": [
      "10-x-antique-brass-table-numbers-1.jpg",
      "10-x-antique-brass-table-numbers-2.jpg",
      "10-x-antique-brass-table-numbers-3.jpg",
      "10-x-antique-brass-table-numbers-4.jpg"
    ],
    "description": "Ten antique brass picture frames with printed inserts: numbers 1–9 and Top Table, or 1–10.\n\n- Personalised table names available at extra cost\n- Or print your own at 7 × 5 inches"
  },
  {
    "slug": "log-slices",
    "name": "Log Slices",
    "price": 30.0,
    "unit": "set of 10",
    "group": "props",
    "images": [
      "log-slices-1.jpg"
    ],
    "description": "Rustic wooden log slices in various sizes, each one slightly different. Ask to see them.\n\n- 10 large and 10 small slices: £45"
  },
  {
    "slug": "round-mirror-plate-table-centre-piece",
    "name": "Round Mirror Plate",
    "price": 2.95,
    "unit": "each",
    "group": "props",
    "images": [
      "round-mirror-plate-table-centre-piece-1.jpg"
    ],
    "description": "A 40cm bevelled round mirror plate. A lovely base for vases, flowers and tealights in the centre of each table.\n\n- 10 for £25; ten available"
  },
  {
    "slug": "sweetjars",
    "name": "Vintage Sweet Jars",
    "price": 4.0,
    "unit": "each",
    "group": "props",
    "images": [
      "sweetjars-1.jpg"
    ],
    "description": "Glass sweet jars, 30cm tall. Fill each with a different sweet and make your own sweet cart.\n\n- 4 for £15; eight available"
  },
  {
    "slug": "tall-glass-dinner-candle-holder",
    "name": "Tall Glass Dinner Candle Holder",
    "price": 4.0,
    "unit": "each",
    "group": "lanterns",
    "images": [
      "tall-glass-dinner-candle-holder-1.jpg",
      "tall-glass-dinner-candle-holder-2.jpg"
    ],
    "description": "Tall, elegant dinner candles in an enclosed glass holder, safe for indoor use. Especially lovely along long tables.\n\n- 30cm tall, 7cm across\n- Ivory dinner candle included\n- The glass gets very hot after a while, so keep out of reach of children\n- Packages also available"
  },
  {
    "slug": "rustic-brass-votive",
    "name": "Rustic Brass Votive",
    "price": 2.5,
    "unit": "each",
    "group": "lanterns",
    "images": [
      "rustic-brass-votive-1.jpg"
    ],
    "description": "A lattice-effect brass votive, 9.5 × 7.5cm, with tealight.\n\n- 10 for £20; twelve available"
  },
  {
    "slug": "sana-storm-lantern-small",
    "name": "Sana Storm Lantern",
    "price": 6.95,
    "unit": "each",
    "group": "lanterns",
    "images": [
      "sana-storm-lantern-small-1.jpg"
    ],
    "description": "A grey steel and glass storm lantern, 25 × 15 × 15cm. The enclosed candle means it works inside and out: down the aisle, on tables, or along a terrace or bridge.\n\n- Pillar candle included (may be part-used, with plenty of burn time left)\n- 6 for £40, 8 for £50; eight available"
  },
  {
    "slug": "swedish-lantern",
    "name": "Swedish Lantern",
    "price": 10.0,
    "unit": "each",
    "group": "lanterns",
    "images": [
      "swedish-lantern-1.jpg",
      "swedish-lantern-2.jpg"
    ],
    "description": "An antique grey metal lantern, 15 × 37cm. The enclosed flame means it's safe indoors.\n\n- Pillar candle included (may be part-used, with plenty of burn time left)\n- Two available"
  },
  {
    "slug": "silver-lantern",
    "name": "Silver Lantern",
    "price": 7.95,
    "unit": "each",
    "group": "lanterns",
    "images": [
      "silver-lantern-1.jpg",
      "silver-lantern-2.jpg"
    ],
    "description": "A quality silver lantern, 42 × 15 × 16cm, that gives off a soft, flickering light. Stunning down the aisle, along a bridge or around the terrace on a summer evening.\n\n- Pillar candle included (may be part-used, with plenty of burn time left)\n- 6 for £45, 8 for £55; eight available"
  },
  {
    "slug": "outdoor-led-hurricane-lantern",
    "name": "Outdoor LED Hurricane Lantern",
    "price": 6.0,
    "unit": "each",
    "group": "lanterns",
    "images": [
      "outdoor-led-hurricane-lantern-1.jpg",
      "outdoor-led-hurricane-lantern-2.jpg"
    ],
    "description": "A battery-powered antique grey metal lantern, 19 × 15.5 × 30cm. Lovely on tables, lining a path or hung up.\n\n- Batteries included\n- 10 for £50; twelve available"
  },
  {
    "slug": "large-white-washed-lantern",
    "name": "Large White-Washed Lantern",
    "price": 15.0,
    "unit": "each",
    "group": "lanterns",
    "images": [
      "large-white-washed-lantern-1.jpg",
      "large-white-washed-lantern-2.jpg"
    ],
    "description": "A large white-washed wooden lantern, about 80cm tall. Perfect framing a doorway or the start of the aisle.\n\n- Pillar candle included (may be part-used, with plenty of burn time left)\n- Also part of the Ceremony Room Set-Up\n- 2 for £30; two available"
  },
  {
    "slug": "rope-lantern",
    "name": "Rope Lantern",
    "price": 8.95,
    "unit": "each",
    "group": "lanterns",
    "images": [
      "rope-lantern-1.jpg",
      "rope-lantern-2.jpg"
    ],
    "description": "A glass lantern with a rope handle, 25 × 18cm. Lovely either side of the entrance, inside or out.\n\n- 2 for £15; two available"
  },
  {
    "slug": "gold-rim-glass-t-light-small",
    "name": "Gold Rim Tealight Holder",
    "price": 1.5,
    "unit": "each",
    "group": "lanterns",
    "images": [
      "gold-rim-glass-t-light-small-1.jpg"
    ],
    "description": "A glass tealight holder with a gold rim, 7 × 6cm. Elegant dotted along every table.\n\n- Tealight included\n- 40 for £45; forty available"
  },
  {
    "slug": "hanging-tea-light",
    "name": "Hanging Tealight Holder",
    "price": 7.5,
    "unit": "per 10",
    "group": "lanterns",
    "images": [
      "hanging-tea-light-1.jpg"
    ],
    "description": "Pretty tealight holders with little bells around the rim, made for hanging in trees. Each 6 × 8cm.\n\n- Tealights not included\n- 20 for £10.50; twenty available"
  },
  {
    "slug": "passu-hanging-tea-light",
    "name": "Passu Hanging Tealight Holder",
    "price": 17.5,
    "unit": "per 10",
    "group": "lanterns",
    "images": [
      "passu-hanging-tea-light-1.jpg",
      "passu-hanging-tea-light-2.jpg",
      "passu-hanging-tea-light-3.jpg",
      "passu-hanging-tea-light-4.jpg"
    ],
    "description": "Distressed white hanging tealight holders, 11cm high, that give a beautifully twinkly light in the trees.\n\n- Takes a standard tealight\n- Sixteen available"
  },
  {
    "slug": "clear-glass-hurricane-vase",
    "name": "Clear Glass Hurricane Vase",
    "price": 6.0,
    "unit": "each",
    "group": "lanterns",
    "images": [
      "clear-glass-hurricane-vase-1.jpg",
      "clear-glass-hurricane-vase-2.jpg"
    ],
    "description": "A 27 × 16.5cm hurricane vase with a pillar candle. Use to line the aisle or as a table centre piece, perhaps with pinecones or dried roses around the base.\n\n- Candle included (may be part-used)\n- 8 for £45, 10 for £55; ten available"
  },
  {
    "slug": "moroccanlantern",
    "name": "Moroccan Lantern",
    "price": 15.0,
    "unit": "each",
    "group": "lanterns",
    "images": [
      "moroccanlantern-1.jpg"
    ],
    "description": "An antique-finish Moroccan lantern with pale blue markings, about 58cm tall. Beautiful against the Mill's red brick.\n\n- Pillar candle included (may be part-used, with plenty of burn time left)\n- Two available"
  },
  {
    "slug": "tall-cylinder-glass-vases",
    "name": "Tall Cylinder Glass Vase",
    "price": 2.5,
    "from": true,
    "unit": "each",
    "group": "lanterns",
    "images": [
      "tall-cylinder-glass-vases-1.jpg"
    ],
    "description": "Tall glass vases in various heights, with candles, floating candles or fairy lights inside. Lovely lining the aisle or on tables.\n\n- Price depends on size\n- Also part of the table centre piece and ceremony room packages"
  },
  {
    "slug": "ndiki-lantern",
    "name": "Ndiki Lantern",
    "price": 17.5,
    "unit": "each",
    "group": "lanterns",
    "images": [
      "ndiki-lantern-1.jpg",
      "ndiki-lantern-2.jpg"
    ],
    "description": "A tall antique brass lantern, 41 × 20 × 20cm. The enclosed flame means it's safe indoors.\n\n- Pillar candle included (may be part-used, with plenty of burn time left)\n- Two available"
  },
  {
    "slug": "sparkling-silver-t-light-small",
    "name": "Sparkling Silver Tealight – Small",
    "price": 10.0,
    "unit": "per 10",
    "group": "lanterns",
    "images": [
      "sparkling-silver-t-light-small-1.jpg"
    ],
    "description": "A rustic silver glass tealight holder with a flower pattern that really sparkles. 7cm high; mix and match with the large ones.\n\n- Tealights included\n- 20 for £18.50, 40 for £35\n- 20 small and 20 large together: £40"
  },
  {
    "slug": "extralargesilverlantern",
    "name": "Extra Large Silver Lantern",
    "price": 15.0,
    "unit": "each",
    "group": "lanterns",
    "images": [
      "extralargesilverlantern-1.jpg",
      "extralargesilverlantern-2.jpg"
    ],
    "description": "A very large silver lantern, 59cm tall, with three pillar candles. Perfect framing a doorway or the start of the aisle, perhaps with rose petals around the base.\n\n- Candles included (may be part-used, with plenty of burn time left)\n- 2 for £30; two available"
  },
  {
    "slug": "hanging-heart-tea-light",
    "name": "Hanging Heart Tealight Holder",
    "price": 7.5,
    "unit": "per 10",
    "group": "lanterns",
    "images": [
      "hanging-heart-tea-light-1.jpg"
    ],
    "description": "Heart-shaped tealight holders for hanging in trees. Each 6 × 8cm.\n\n- Tealights not included\n- 20 for £10.50; twenty available"
  },
  {
    "slug": "mohani-lantern",
    "name": "Mohani Lantern",
    "price": 10.5,
    "unit": "each",
    "group": "lanterns",
    "images": [
      "mohani-lantern-1.jpg",
      "mohani-lantern-2.jpg"
    ],
    "description": "An asymmetric antique brass lantern, 26 × 16cm. A lovely table centre piece, and stunning lining the aisle or dotted around the terrace on a summer evening.\n\n- Pillar candle included (may be part-used, with plenty of burn time left)\n- 10 for £95; twelve available"
  },
  {
    "slug": "sparkling-silver-t-light-large",
    "name": "Sparkling Silver Tealight – Large",
    "price": 1.5,
    "unit": "each",
    "group": "lanterns",
    "images": [
      "sparkling-silver-t-light-large-1.jpg",
      "sparkling-silver-t-light-large-2.jpg"
    ],
    "description": "A rustic silver glass tealight holder with a flower pattern that really sparkles. 9cm high; mix and match with the small ones.\n\n- Tealights included\n- 10 for £15, 20 for £25, 40 for £40\n- 20 small and 20 large together: £40"
  }
];
