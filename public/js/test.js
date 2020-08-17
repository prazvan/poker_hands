const PokerHand = require('poker-evaluator');

let p1 = PokerHand.evalHand(["As", "Ac", "Ad", "5d", "5s"]);
let p2 = PokerHand.evalHand(["As", "2c", "Ad", "5d", "5s"]);

console.log(p1.value > p2.value);

// console.log(myPokerHand.describe());
// // { hand: [ 'KS', 'KH', 'QC', 'AH', 'AD' ],
// //   score: 2468,
// //   rank: 'TWO_PAIRS' }
//
// console.log(hisPokerHand.describe());
// // { hand: [ 'KD', 'KC', 'AS', 'AH', 'TD' ],
// //   score: 2470,
// //   rank: 'TWO_PAIRS' }
//
// console.log(myPokerHand.getRank());
// // TWO_PAIRS
// console.log(hisPokerHand.getRank());
// // TWO_PAIRS
//
// console.log(myPokerHand.getScore());
// // 2468
// console.log(hisPokerHand.getScore());
// // 2470
//
// console.log(myPokerHand.toString());
// // KS KH QC AH AD
// console.log(hisPokerHand.toString());
// // KD KC AS AH TD
//
//
// /**
//  * return 1 if it's a Win
//  * return 2 if it's a Loss
//  * return 3 if it's a Tie
//  */
// console.log(myPokerHand.compareWith(hisPokerHand));
// // 1