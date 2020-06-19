function allowBlockList() {
  console.log("allowBlockList");
  var allowedBlocks = [
    "wpshopify/buy-button",
    "wpshopify/products",
    "wpshopify/single-product",
  ];

  wp.blocks.getBlockTypes().forEach(function (blockType) {
    console.log("blockType", blockType);

    if (allowedBlocks.indexOf(blockType.name) === -1) {
      console.log("blockType.name", blockType.name);

      wp.blocks.unregisterBlockType(blockType.name);
    }
  });
}

allowBlockList();
