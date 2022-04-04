/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/draggable.js ***!
  \***********************************/
var wrapper, oldList, items, buttons, listEnd, status, wrapperFrag;
var gapHeight, firstGap;
var curName, curItem, curButton, curDraggedEl;
var grabCoords;
var statusTimer;

function debounce(func, delay) {
  var inDebounce;
  return function () {
    var context = this;
    var args = arguments;
    clearTimeout(inDebounce);
    inDebounce = setTimeout(function () {
      return func.apply(context, args);
    }, delay);
  };
}

function itemDragStart(e) {
  //console.log("dragstart");
  // add drag styling
  e.target.parentElement.classList.add('__itemDrag');
  items.forEach(function (item) {
    item.classList.remove('__itemDragover');
  }); // set currently dragged item

  curDraggedEl = e.target; // set mouse coords of grab

  grabCoords.x = e.layerX;
  grabCoords.y = e.layerY; // set drag data

  e.dataTransfer.effectAllowed = 'move';
  e.dataTransfer.setData('text/plain', curItem); // set drag image
  //e.dataTransfer.setDragImage(curDraggedEl,grabCoords.x,grabCoords.y);
  // feedback message

  announceStatus("".concat(curName, " being dragged."));
}

function itemDragEnd(e) {
  //console.log('dragend');
  // remove drag styling
  e.target.parentElement.classList.remove('__itemDrag');
  e.target.parentElement.classList.remove('__itemGrab');
  items.forEach(function (item) {
    item.classList.remove('__itemDragover');
  });
}

function itemDragOver(e) {
  if (e.preventDefault) e.preventDefault();
  return false;
}

function itemDragEnter(e) {
  //console.log("dragenter");
  // get position of item dragged over
  var pos = parseInt(e.target.parentElement.dataset.pos) + 1; // check that item isn't being dragged over itself

  if (pos !== curItem + 1) {
    // add drag over styling
    e.target.parentElement.classList.add('__itemDragover'); // set drag data

    e.dataTransfer.dropEffect = 'move'; // feedback message

    announceStatus("Entered drag area for #".concat(pos, ", ").concat(e.target.dataset.name, ". Drop to swap positions."));
  } else {
    // set drag data
    e.dataTransfer.dropEffect = 'none';
  }
}

function itemDragLeave(e) {
  //console.log("dragleave");
  // remove drag over styling
  e.target.parentElement.classList.remove('__itemDragover'); // feedback message
  //announceStatus(`Left drag area for ${e.target.dataset.name}.`);
}

function itemDrop(e) {
  //console.log("drop");
  // stop browser redirect
  e.preventDefault();
  e.stopPropagation(); // remove drag styling

  curDraggedEl.parentElement.classList.remove('__itemDrag');
  curDraggedEl.parentElement.classList.remove('__itemGrab'); //curDraggedEl.parentElement.classList = 'rankingsItem';
  // check that item was dropped on a different one

  if (curDraggedEl !== e.target) {
    // get #'s of items we're swapping
    var pos1 = parseInt(e.dataTransfer.getData('text/plain'));
    var pos2 = parseInt(e.target.parentElement.dataset.pos); // update grab coordinates

    grabCoords.x = grabCoords.x - e.layerX;
    grabCoords.y = grabCoords.y - e.layerY; // swap items

    swapItems(pos1, pos2); // move focus to item

    items[pos2].focus(); // do drop transition

    transitionDropItem(pos2, grabCoords.x, grabCoords.y); // do slide transition

    transitionSlideItem(pos1, pos2 - pos1, false, .35); // feedback message
    // item [pos1] moved to [pos2], item [pos2] moved to [pos1]

    announceStatus("Items ".concat(pos1 + 1, " and ").concat(pos2 + 1, " swapped: ").concat(curName, " moved to #").concat(pos2 + 1, "."));
  } // some browsers need this to prevent redirect


  return false;
}

function gapDragEnter(e) {
  //console.log("gapdragenter");
  // get position of gap
  var pos = parseInt(e.target.dataset.pos); // check if gap is above or below item being dragged

  if (curItem !== pos && curItem !== pos - 1) {
    // show gap
    e.target.classList.add('__gapDragover'); // set drag data

    e.dataTransfer.dropEffect = 'move'; // setup feedback message

    var message = ''; // if first gap

    if (pos == 0) {
      message += "Entered drag area for gap before #1. Drop to move item to #1 and shift other items down."; // if gap is last
    } else if (pos == items.length) {
      message += "Entered drag area for gap after #".concat(items.length, ". Drop to move item to #").concat(items.length, " and shift other items up."); // if gap is in the middle
    } else {
      message = "Entered drag area for gap between ".concat(pos, " and ").concat(pos + 1, ". "); // if we're dragging item above where it originatetd

      if (pos < curItem) {
        message += "Drop to move item to #".concat(pos + 1, " and shift other items down."); // if we're dragging item below where it originated
      } else {
        message += "Drop to move item to #".concat(pos, " and shift other items up.");
      }
    } // announce feedback message


    announceStatus(message);
  } else {
    // set drag data
    e.dataTransfer.dropEffect = 'none';
  }
}

function gapDragLeave(e) {
  //console.log("gapdragleave");
  // hide gap
  e.target.classList.remove('__gapDragover');
}

function gapDragOver(e) {
  if (e.preventDefault) e.preventDefault();
  return false;
}

function gapDrop(e) {
  // stop browser redirect
  e.preventDefault();
  e.stopPropagation(); // remove drag styling on gap

  e.target.classList.remove('__gapDragover'); // remove drag styling

  curDraggedEl.parentElement.classList.remove('__itemDrag');
  curDraggedEl.parentElement.classList.remove('__itemGrab'); // get position of gap

  var pos = parseInt(e.target.dataset.pos); // get distance dragged item is moving

  var dis = pos - curItem; // check if gap is above or below item being dragged

  if (curItem !== pos && curItem !== pos - 1) {
    // update grab coordinates
    grabCoords.x = grabCoords.x - e.layerX;

    if (dis < 0) {
      grabCoords.y = gapHeight - e.layerY + grabCoords.y;
    } else {
      grabCoords.y = -items[curItem].getBoundingClientRect().height - e.layerY + grabCoords.y;
    } // shift items


    shiftItems(curItem, dis);
  } // some browsers need this to prevent redirect


  return false;
}

function transitionSlideItem(pos, dis) {
  var front = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
  var decay = arguments.length > 3 ? arguments[3] : undefined;
  // vars
  var cls; // get item

  var item = items[pos]; // get duration css var to use as setTimeout duration later

  var dur = parseFloat(getComputedStyle(item).getPropertyValue('--dur')) * 1000 || 0; // var to keep track of rate of change

  var rate; // check if we're moving an item more than 1 row and if a decay number was passed in

  if (Math.abs(dis) > 1 && decay) {
    rate = 0; // loop through number of rows we're moving item and add a decay to the rate of change

    for (var i = 0; i < Math.abs(dis); i++) {
      rate += 1 - i * decay;
    } // set duration to match rate


    dur *= rate; // if moving only one row
  } else {
    // set rate var to have no change
    rate = Math.abs(dis);
  } // determine if row should be in front or back and add relevant class


  if (front) {
    cls = '__slideFront';
  } else {
    cls = '__slideBack';
  } // set value of css vars so item knows which direction to move and how far


  item.style.setProperty('--dis', dis);
  item.style.setProperty('--abs', rate); // add class to kick off animationn

  item.classList.add(cls); // remove class after animation has finished so as to not affect future animations

  setTimeout(function () {
    item.classList.remove(cls);
  }, dur);
}

function transitionShakeItem(pos) {
  // get item
  var item = items[pos]; // add class to kick off animation

  item.classList.add('__shake'); // remove class after animation has finished

  setTimeout(function () {
    item.classList.remove('__shake');
  }, 400);
}

function transitionDropItem(pos) {
  var dropX = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
  var dropY = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 0;
  // get item
  var item = items[pos]; // update css vars so row will slide from dropped position

  item.style.setProperty('--dropX', -dropX);
  item.style.setProperty('--dropY', -dropY); // add class to kick off animation

  item.classList.add('__drop'); // remove class after animation has finished

  setTimeout(function () {
    item.classList.remove('__drop');
  }, 300);
}

function moveItemUp(pos) {
  // convert pos to number so we can math
  pos = parseInt(pos); // check to make sure we're not in the first row

  if (pos > 0) {
    // get positions of items
    var pos1 = pos - 1;
    var pos2 = pos; // get ref to up button

    var button = items[pos2].querySelector('.rankingsItem--up'); // swap items

    swapItems(pos2, pos1); // move focus to down button

    button.focus(); // do slide transitions

    transitionSlideItem(pos1, 1);
    transitionSlideItem(pos2, -1, false); // feedback message
    // item [pos2] moved to [pos1], item [pos1] moved to [pos2]

    announceStatus("".concat(curName, " moved up to #").concat(pos2, "."));
  } else {
    // get ref to up button
    var _button = items[pos].querySelector('.rankingsItem--up'); // move focus to up button


    _button.focus(); // do shake animation


    transitionShakeItem(pos); // feedback message
    // item 1 is the first item and can't be moved up

    announceStatus("".concat(curName, " is #1 and can't move up."));
  }
}

function moveItemDown(pos) {
  // convert pos to number so we can math
  pos = parseInt(pos); // check to make sure we're not in the last row

  if (pos < items.length - 1) {
    // get positions of items
    var pos1 = pos;
    var pos2 = pos + 1; // get ref to down button

    var button = items[pos1].querySelector('.rankingsItem--down'); // swap items

    swapItems(pos1, pos2); // move focus to down button

    button.focus(); // do slide transitions

    transitionSlideItem(pos1, 1, false);
    transitionSlideItem(pos2, -1); // feedback message
    // item [pos1] moved to [pos2], item [pos2] moved to [pos1]

    announceStatus("".concat(curName, " moved down to #").concat(pos2 + 1, "."));
  } else {
    // get ref to down button
    var _button2 = items[pos].querySelector('.rankingsItem--down'); // move focus to down button


    _button2.focus(); // do shake animation


    transitionShakeItem(pos); // feedback message
    // item [pos] is the last item and can't be moved down

    announceStatus("".concat(curName, " is #").concat(items.length, " and can't move down."));
  }
}

function shiftItems(pos, dis) {
  var inner, item1, item2, newPos, id, name, marker, message; // get temp copy of items

  var tempItems = Array.prototype.slice.call(items); // get inner of element being dragged

  inner = items[pos].querySelector('.rankingsItem--inner'); // get original position of item we're moving

  id = inner.dataset.origin; // if we're moving an element up (+ shifting other elements down)

  if (dis < 0) {
    // get partial array containing only the items being shifted
    tempItems = tempItems.slice(pos + dis, pos + 1); // move inner to new item

    item1 = tempItems[0];
    item1.appendChild(inner); // update label

    updateLabel(pos + dis, id); // loop through array of partial items to take inner from one and place it inside the next

    for (var i = 0; i < tempItems.length - 1; i++) {
      // get references to items we'll be swapping inners of
      item1 = tempItems[i];
      item2 = tempItems[i + 1]; // get inner so we can move it down one row

      inner = item1.querySelector('.rankingsItem--inner'); // get label id for moved item

      id = inner.querySelector('.rankingsItem--text').id.substr(4); // move inner to next item

      item2.appendChild(inner); // update label

      marker = parseInt(item1.dataset.pos) + 1;
      updateLabel(marker, id);
    } // get new position of item that was dragged


    newPos = pos + dis; // feedback message

    message = "".concat(curName, " moved up to #").concat(newPos + 1);

    if (Math.abs(dis) == 1) {
      message += ", item ".concat(newPos + 1, " shifted down.");
    } else {
      message += ", items ".concat(newPos + 1, "-").concat(newPos + Math.abs(dis), " shifted down.");
    }

    announceStatus(message); // do drop transition on dragged item

    transitionDropItem(newPos, grabCoords.x, grabCoords.y); // loop through shifted items and slide transition them

    for (var _i = newPos; _i < newPos + Math.abs(dis); _i++) {
      transitionSlideItem(_i + 1, -1, false);
    } // if we're moving an element down (+ shifting other elements up)

  } else {
    // get partial array containing only the items being shifted
    tempItems = tempItems.slice(pos, pos + dis); // move inner to new item

    item1 = tempItems[tempItems.length - 1];
    item1.appendChild(inner); // update label

    updateLabel(pos + dis - 1, id); // loop through partial array and take inner from one item and place it inside the next

    for (var _i2 = tempItems.length - 1; _i2 > 0; _i2--) {
      // get references to items we're using
      item1 = tempItems[_i2];
      item2 = tempItems[_i2 - 1]; // get inner so we can move it up one row

      inner = item1.querySelector('.rankingsItem--inner'); // get label id for next item

      id = inner.querySelector('.rankingsItem--text').id.substr(4); // move inner to next iteam

      item2.appendChild(inner); // update label

      marker = parseInt(item1.dataset.pos) - 1;
      updateLabel(marker, id);
    } // get new position of item that was dragged


    newPos = pos + dis - 1; // feedback message

    message = "".concat(curName, " moved down to #").concat(newPos + 1);

    if (Math.abs(dis - 1) == 1) {
      message += ", item ".concat(newPos + 1, " shifted up.");
    } else {
      message += ", items ".concat(newPos + 1 - (dis - 1) + 1, "-").concat(newPos + 1, " shifted up.");
    }

    announceStatus(message); // do drop transition on dragged item

    transitionDropItem(newPos, grabCoords.x, grabCoords.y); // loop through changed rows and transition them

    for (var _i3 = newPos - 1; _i3 > newPos - dis; _i3--) {
      transitionSlideItem(_i3, 1, false);
    }
  } // move focus to dragged item


  items[newPos].focus();
}

function swapItems(pos1, pos2) {
  // get items in question
  var item1 = items[pos1];
  var item2 = items[pos2]; // get inners we're swapping

  var inner1 = item1.querySelector('.rankingsItem--inner');
  var inner2 = item2.querySelector('.rankingsItem--inner'); // update labels

  var id1 = inner1.dataset.origin;
  var id2 = inner2.dataset.origin;
  updateLabel(pos1, id2);
  updateLabel(pos2, id1); // move inners from one item to the other

  item1.appendChild(inner2);
  item2.appendChild(inner1);
}

function updateFocusInfo(pos) {
  // get name of item we're moving
  var name = items[pos].querySelector('.rankingsItem--inner').dataset.name; // check if prev item and new item are different (means new row was selected)

  if (curItem !== pos) {
    // get buttons within new item
    buttons = items[pos].querySelectorAll('button'); // take prev item out of tab order and put new item in tab order

    items[curItem].tabIndex = -1;
    items[pos].tabIndex = 0;
  } // update current item vars


  curItem = parseInt(pos);
  curName = name;
  curButton = null;
}

function itemFocus(e) {
  updateFocusInfo(e.target.dataset.pos);
}

function buttonFocus(e) {
  // update focus info
  updateFocusInfo(e.target.parentElement.parentElement.parentElement.dataset.pos); // expose focused button to screen reader
  //e.target.setAttribute('aria-hidden','false');
  // update current button var

  curButton = e.target.dataset.pos;
}

function buttonBlur(e) {// hide button from screen reader
  //e.target.setAttribute('aria-hidden','true');
}

function itemKeyDown(e) {
  var keyCode = e.keyCode || e.which;

  switch (keyCode) {
    case 32: // space

    case 13:
      // enter
      break;

    case 27:
      // esc
      e.preventDefault(); //list.focus();

      listEnd.focus();
      break;

    case 37:
      // left
      e.preventDefault(); // check if curButton doesn't exist yet (meaning new item was selected)

      if (!curButton) curButton = buttons.length; // if we're not at first button

      if (curButton > 0) {
        // update current button var and move focus to it
        curButton--;
        buttons[curButton].focus(); // if we're at first button
      } else {
        // set focus to button's parent
        items[curItem].focus();
      } // move focus to prev button
      //getPrevButton(curButton).focus();


      break;

    case 38:
      // up
      e.preventDefault(); // move focus to prev item

      getPrevItem(curItem).focus();
      break;

    case 39:
      // right
      e.preventDefault(); // check if curButton doesn't exist yet (meaning new item was selected)

      if (!curButton) curButton = -1; // if we're not at last button

      if (curButton < buttons.length - 1) {
        // update current button var and move focus to it
        curButton++;
        buttons[curButton].focus(); // if we're at last button
      } else {
        // set focus to button's parent
        items[curItem].focus();
      } // move focus to next button
      //getNextButton(curButton).focus();


      break;

    case 40:
      // down
      e.preventDefault(); // move focus to next item

      getNextItem(curItem).focus();
      break;

    case 9:
      // tab
      break;

    case 33:
      // page up
      e.preventDefault(); // move focus to first item

      items[0].focus();
      break;

    case 34:
      // page down
      e.preventDefault(); // move focus to last item

      items[items.length - 1].focus();
      break;

    default:
      break;
  }
}

function getPrevItem(pos) {
  if (pos > 0) {
    pos--;
  } else {
    pos = items.length - 1;
  }

  return items[pos];
}

function getNextItem(pos) {
  if (pos < items.length - 1) {
    pos++;
  } else {
    pos = 0;
  }

  return items[pos];
}

function getPrevButton(pos) {
  if (pos > 0) {
    pos--;
  } else {
    pos = buttons.length - 1;
  }

  return buttons[pos];
}

function getNextButton(pos) {
  if (pos < buttons.length - 1) {
    pos++;
  } else {
    pos = 0;
  }

  return buttons[pos];
}

function announceStatus(message) {
  // clear any previous timers
  clearTimeout(statusTimer); // set text of status element

  status.innerText = message; // set up timer to clear status

  statusTimer = setTimeout(function () {
    status.innerText = '';
  }, 5000);
}

function updateLabel(pos, num) {
  items[pos].setAttribute('aria-labelledby', "marker".concat(pos + 1, " name").concat(num));
}

function setupItem(list, oldItem, pos) {
  // get elements
  var oldInner = oldItem.querySelector('.rankingsItem--inner'); // let oldImg = oldInner.querySelector('img.rankingsItem--photo');

  var oldText = oldInner.querySelector('.rankingsItem--text');
  var name = oldText.innerText; // set up new item

  var item = document.createElement('div');
  item.classList = "rankingsItem";
  item.setAttribute('aria-labelledby', "marker".concat(pos + 1, " name").concat(pos + 1));
  item.setAttribute('role', 'listitem');
  item.dataset.pos = pos;
  item.tabIndex = -1; // set up marker

  var marker = document.createElement('div');
  marker.id = "marker".concat(pos + 1);
  marker.classList = "rankingsItem--marker";
  marker.innerText = "".concat(pos + 1, "."); // set up inner

  var inner = document.createElement('div');
  inner.classList = "rankingsItem--inner";
  inner.dataset.name = name;
  inner.dataset.origin = pos + 1;
  inner.setAttribute('draggable', 'true');
  inner.addEventListener('dragstart', itemDragStart, false);
  inner.addEventListener('dragend', itemDragEnd, false);
  inner.addEventListener('dragenter', itemDragEnter, false);
  inner.addEventListener('dragleave', itemDragLeave, false);
  inner.addEventListener('dragover', itemDragOver, false);
  inner.addEventListener('drop', itemDrop, false);
  inner.addEventListener('mousedown', function (e) {
    e.target.parentElement.classList.add('__itemGrab');
  }, false);
  inner.addEventListener('mouseup', function (e) {
    e.target.parentElement.classList.remove('__itemGrab');
  }, false);
  /* This event fixes a bug in Android Chrome where draging non-focused element does not assign focus and will result in wrong element being moved */

  inner.addEventListener('pointerdown', function (e) {
    updateFocusInfo(e.target.parentElement.dataset.pos);
    e.target.focus();
  }, false); // set up name and image elements

  var text = oldText.cloneNode(true); // let img = oldImg.cloneNode(true);
  // set up buttons

  var buttons = [];
  var buttonSpan, buttonSvg, buttonUse;
  var ns = 'http://www.w3.org/2000/svg';
  var ns2 = 'http://www.w3.org/1999/xlink'; // button wrapper

  var buttonWrapper = document.createElement('div');
  buttonWrapper.classList = "rankingsItem--buttons"; // up button

  var upButton = document.createElement('button');
  upButton.classList = "rankingsItem--up";
  buttonSpan = document.createElement('span');
  buttonSpan.classList = "visuallyHidden";
  buttonSpan.innerText = "Move up";
  buttonSvg = document.createElementNS(ns, 'svg');
  buttonSvg.setAttributeNS(ns, 'width', '16');
  buttonSvg.setAttributeNS(ns, 'height', '16');
  buttonSvg.setAttributeNS(ns, 'focusable', 'false');
  buttonSvg.setAttributeNS(ns, 'aria-hidden', 'true');
  buttonUse = document.createElementNS(ns, 'use');
  buttonUse.setAttributeNS(ns2, 'xlink:href', '#icon--up');
  buttonSvg.appendChild(buttonUse);
  upButton.appendChild(buttonSpan);
  upButton.appendChild(buttonSvg);
  buttons.push(upButton); // down button

  var downButton = document.createElement('button');
  downButton.classList = "rankingsItem--down";
  buttonSpan = document.createElement('span');
  buttonSpan.classList = "visuallyHidden";
  buttonSpan.innerText = "Move up";
  buttonSvg = document.createElementNS(ns, 'svg');
  buttonSvg.setAttributeNS(ns, 'width', '16');
  buttonSvg.setAttributeNS(ns, 'height', '16');
  buttonSvg.setAttributeNS(ns, 'focusable', 'false');
  buttonSvg.setAttributeNS(ns, 'aria-hidden', 'true');
  buttonUse = document.createElementNS(ns, 'use');
  buttonUse.setAttributeNS(ns2, 'xlink:href', '#icon--down');
  buttonSvg.appendChild(buttonUse);
  downButton.appendChild(buttonSpan);
  downButton.appendChild(buttonSvg);
  buttons.push(downButton); // add elements to inner

  buttonWrapper.appendChild(upButton);
  buttonWrapper.appendChild(downButton);
  inner.appendChild(text); // inner.appendChild(img);

  inner.appendChild(buttonWrapper); // add elements to item

  item.appendChild(marker);
  item.appendChild(inner); //updateLabel(pos,pos+1);
  // loop through buttons in each inner and set common functionality

  for (var i = 0; i < buttons.length; i++) {
    buttons[i].type = "button";
    buttons[i].tabIndex = "-1";
    buttons[i].dataset.pos = i; // add event listener

    buttons[i].addEventListener('focus', buttonFocus);
    buttons[i].addEventListener('blur', buttonBlur);
  } // change label of move up/down buttons


  upButton.children[0].innerText = "Move up ".concat(name);
  downButton.children[0].innerText = "Move down ".concat(name); // add event listeners for move up/down buttons

  upButton.addEventListener('click', function (e) {
    moveItemUp(curItem);
  });
  upButton.addEventListener('pointerdown', function (e) {
    e.stopPropagation();
  });
  downButton.addEventListener('click', function (e) {
    moveItemDown(curItem);
  });
  downButton.addEventListener('pointerdown', function (e) {
    e.stopPropagation();
  }); // add event listeners for item

  item.addEventListener('focus', itemFocus);
  item.addEventListener('keydown', itemKeyDown); // create gap below item

  var gap = setupGap(pos + 1); // add item and gap to list

  list.appendChild(item);
  list.appendChild(gap);
}

function setupGap(pos) {
  var gap = document.createElement('div'); // set gap props
  // gap.classList.add('rankingsGap');

  gap.dataset.pos = pos;
  gap.setAttribute('aria-hidden', 'true'); // set up gap event listeners

  gap.addEventListener('dragenter', gapDragEnter, false);
  gap.addEventListener('dragleave', gapDragLeave, false);
  gap.addEventListener('dragover', gapDragOver, false);
  gap.addEventListener('drop', gapDrop, false);
  return gap;
}

function setGapHeight() {
  // get gap height var from CSS
  var height = getComputedStyle(wrapper).getPropertyValue('--rowGap').trim(); // get current base font size

  var fontSize = getComputedStyle(document.documentElement).getPropertyValue('font-size').substr(0, 2); // determine actual height of gap

  gapHeight = parseInt(height.substr(0, height.length - 2)) * parseInt(fontSize); //gapHeight = firstGap.getBoundingClientRect().height;
  //console.log(gapHeight);
}

function setup() {
  // get wrapper and list element
  wrapper = document.querySelector('.rankings');
  oldList = wrapper.querySelector('ol'); // get gap height

  setGapHeight(); // create document fragment to build new DOM structure

  wrapperFrag = document.createDocumentFragment(); // create application element

  var app = document.createElement('div');
  app.setAttribute('role', 'application');
  app.setAttribute('aria-roledescription', 'Reorderable List widget');
  app.setAttribute('aria-labelledby', 'heading'); //app.setAttribute('aria-describedby','instructions');

  wrapperFrag.appendChild(app); // create list element

  var list = document.createElement('div');
  list.setAttribute('role', 'list');
  app.appendChild(list); // set up gap above list

  firstGap = setupGap(0);
  list.appendChild(firstGap); // loop through old list items and set up new ones

  items = oldList.querySelectorAll('.rankingsItemLowfi');

  for (var i = 0; i < items.length; i++) {
    setupItem(list, items[i], i);
  } // get updated array of items


  items = list.querySelectorAll('.rankingsItem'); // make first item focusable initially

  items[0].tabIndex = 0; // set up escape element

  listEnd = document.createElement('div');
  listEnd.classList = 'rankingsEnd visuallyHidden';
  listEnd.textContent = 'End of Reorderable List widget.';
  listEnd.tabIndex = -1;
  wrapperFrag.appendChild(listEnd); // set up live region for accouncements

  status = document.createElement('div');
  status.classList = 'rankingsStatus visuallyHidden';
  status.setAttribute('role', 'status');
  status.setAttribute('aria-live', 'assertive');
  status.setAttribute('aria-atomic', 'true');
  wrapperFrag.appendChild(status); // set initial vars

  curName = '';
  curItem = 0;
  curButton = null;
  grabCoords = {
    x: 0,
    y: 0
  }; // add new rankings DOM to page

  wrapper.innerHTML = '';
  wrapper.appendChild(wrapperFrag); // set up resize handler

  /*window.addEventListener('resize', debounce(() => {
  	setGapHeight();
  }, 1000));*/
}

document.addEventListener('DOMContentLoaded', function () {
  console.clear();
  setup();
});
/******/ })()
;