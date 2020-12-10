// import
import $ from 'jquery';
import { crud, appendCSS } from './utils';
import { cssTemp, formTemp } from './temp';
import { appendComment, appendLoadMoreBtn } from './appendFunc';
// initialize
export function init(options) {
  // count
  let begin = 0;// 從第幾筆載入
  let count = 5;// 一次載入幾筆

  // get options
  const siteKey = options.siteKey;
  const apiUrl = options.apiUrl;

  // append comment and load more btn
  $('.container').append(formTemp(siteKey, options.containerSelector));
  appendLoadMoreBtn($('.container'), siteKey);

  // variables
  const commentsDOM = $(`.${siteKey}-comments`);
  const loadMoreBtnDOM = $(`.${siteKey}-load-more`);
  const formClass = `.${siteKey}-add_comment_form`;
  const formDOM = $(formClass);
  const inputForm = $(`#${siteKey}textForUsername`);
  const textareaForm = $(`#${siteKey}textareaForContent`);
  const objectForAppend = {
    type: 'GET',
    url: `${apiUrl}comments_api.php?site_key=${siteKey}`,
  };

  // append css
  appendCSS(cssTemp);

  // 取得留言
  function getComments(begin, count, objects) {
    const start = begin;
    const end = start + count; // 要顯示的最後一筆
    crud(objects, (data) => {
      const comments = data.comments;
      if (end >= comments.length) {
        end = comments.length;
        loadMoreBtnDOM.hide();
      }
      for (let i = start; i < end; i++) {
        appendComment(commentsDOM, comments[i]);
      }
    });
  }
  getComments(begin, count, objectForAppend);

  // 新增留言
  formDOM.submit((e) => {
    e.preventDefault();
    const newComment = {
      site_key: siteKey,
      username: inputForm.val(),
      comment_content: textareaForm.val(),
    };
    const objectForAdd = {
      type: 'POST',
      url: `${apiUrl}add_comment_api.php?`,
      data: newComment,
    };
    crud(objectForAdd, () => {
      inputForm.val('');
      textareaForm.val('');
      appendComment(commentsDOM, newComment, true);
      // 若新增後 comments 大於五個則移除至維持五個
      if(commentsDOM.children().length >= 5) {
        commentsDOM.children().last().remove();
      }
    });
  });

  // load more
  loadMoreBtnDOM.click(() => {
    begin += count;
    getComments(begin, count, objectForAppend);
  });
}
