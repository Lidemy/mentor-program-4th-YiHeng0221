export const cssTemp = `
  .card {
    margin-top: 1.5em;
  }
`;

export function formTemp(siteKey, containerSelector) {
  return `
  <div class="${containerSelector}">
    <form class="${siteKey}-add_comment_form">
      <div class="form-group">
        <label class= "mt-2" for="${siteKey}textForUsername">暱稱</label>
        <input name="username" class="form-control" id="${siteKey}textForUsername"type="text" placeholder="請輸入暱稱">
        <label class= "mt-2" for="${siteKey}textareaForContent">留言內容</label>
        <textarea name="comment_content" class="form-control" id="${siteKey}textareaForContent" rows="3" placeholder="請輸入留言"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <div class="${siteKey}-comments">
    </div>
  </div>
  `;
}
