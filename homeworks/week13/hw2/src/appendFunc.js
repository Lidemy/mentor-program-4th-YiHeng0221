import { escapeHTML } from './utils';

// functions
function loadMoreBtn(siteKey) {
  return `<button class="mt-3 btn btn-primary ${siteKey}-load-more">載入更多</button>`;
}

// 載入留言
export function appendComment(container, comment, isPrepend) {
  const temp = `
    <div class="card">
    <div class="card-body">
      <h5 class="card-title mb-0">${escapeHTML(comment.username)}</h5>
      <p class="card-text">${escapeHTML(comment.comment_content)}</p>
    </div>
  </div>
  `;
  if (isPrepend) {
    container.prepend(temp);
  } else {
    container.append(temp);
  }
}

// 載入更多按鈕
export function appendLoadMoreBtn(element, siteKey) {
  element.append(loadMoreBtn(siteKey));
}
