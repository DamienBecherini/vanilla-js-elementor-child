/**
 * File main.js.
 *
 * Entry point compiled by Grunt (browserify + babelify) into assets/js/dist/main.js.
 */
import { scrollTopButton } from "./components/scrollTopButton";
// import { slidingPanels } from "./components/slidingPanels";
// import { header } from "./components/header";

/**
 * ID of the Elementor popup used as the mobile menu (Elementor > Templates > Popups).
 * Scrolling of the page behind it is locked while it is open.
 * null locks the scroll for every Elementor popup; replace it with the ID of the
 * menu popup to limit the lock to that one.
 */
const MENU_ELEMENTOR_POPUP_ID = null;

function docReady(fn) {
  // https://stackoverflow.com/a/9899701
  // see if DOM is already available
  if (
    document.readyState === "complete" ||
    document.readyState === "interactive"
  ) {
    // call on next available tick
    setTimeout(fn, 1);
  } else {
    document.addEventListener("DOMContentLoaded", fn);
  }
}

docReady(function () {
  // DOM is loaded and ready for manipulation here

  scrollTopButton.init();
  // slidingPanels.init();
  // header.init("moving-header");

  elementorPopupScrollLock(MENU_ELEMENTOR_POPUP_ID);
});

/**
 * Lock the page scroll while a given Elementor Pro popup is open.
 *
 * Elementor Pro triggers "elementor/popup/show" and "elementor/popup/hide" through jQuery,
 * with the handler signature (event, id, instance). Native listeners do not receive
 * jQuery-triggered events, so jQuery is used when it is present on the page.
 * Native CustomEvents carrying { id } in event.detail are handled as well; both paths
 * are idempotent, so receiving the same opening twice does no harm.
 *
 * @param {number|null} popupId - Elementor popup ID, or null for every popup
 */
function elementorPopupScrollLock(popupId = null) {
  const isTargetPopup = (id) =>
    popupId === null || Number(id) === Number(popupId);

  const lockScroll = (id) => {
    if (isTargetPopup(id)) {
      document.body.style.overflowY = "hidden";
    }
  };

  const unlockScroll = (id) => {
    if (isTargetPopup(id)) {
      document.body.style.removeProperty("overflow-y");
    }
  };

  // jQuery events (Elementor Pro)
  if (typeof window.jQuery === "function") {
    window.jQuery(document).on("elementor/popup/show", (event, id) => {
      lockScroll(id);
    });
    window.jQuery(document).on("elementor/popup/hide", (event, id) => {
      unlockScroll(id);
    });
  }

  // Native CustomEvents (event.detail.id), dispatched on window or document
  const getDetailId = (event) =>
    event && event.detail ? event.detail.id : undefined;

  [window, document].forEach((target) => {
    target.addEventListener("elementor/popup/show", (event) => {
      lockScroll(getDetailId(event));
    });
    target.addEventListener("elementor/popup/hide", (event) => {
      unlockScroll(getDetailId(event));
    });
  });
}
