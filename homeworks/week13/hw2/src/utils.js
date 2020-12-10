import $ from 'jquery';

// 增刪查改
export function crud(objects, cb) {
  $.ajax(objects).done(data => {
    if (!data.ok) {
      alert(data.message);
      return;
    }
    cb(data);
  });
}

// 跳脫字元
export function escapeHTML(toOutput) {
  return toOutput.replace(/\&/g, '&amp;')
    .replace(/\</g, '&lt;')
    .replace(/\>/g, '&gt;')
    .replace(/\"/g, '&quot;')
    .replace(/\'/g, '&#x27')
    .replace(/\//g, '&#x2F');
}

// css
export function appendCSS(cssTemp) {
  const styleElement = document.createElement('style');
  styleElement.type = 'text/css';
  styleElement.appendChild(document.createTextNode(cssTemp));
  document.head.appendChild(styleElement);
}
