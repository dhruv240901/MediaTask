/**
 * Tagify
 */

'use strict';

// const { forEach } = require('lodash');

(function () {
  // Basic
  //------------------------------------------------------
  const tagifyBasicEl = document.querySelector('#TagifyBasic');
  const TagifyBasic = new Tagify(tagifyBasicEl);

  // Read only
  //------------------------------------------------------
  const tagifyReadonlyEl = document.querySelector('#TagifyReadonly');
  const TagifyReadonly = new Tagify(tagifyReadonlyEl);

  // Custom list & inline suggestion
  //------------------------------------------------------
  const TagifyCustomInlineSuggestionEl = document.querySelector('#TagifyCustomInlineSuggestion');
  const TagifyCustomListSuggestionEl = document.querySelector('#TagifyCustomListSuggestion');

  const whitelist = [
    'A# .NET',
    'A# (Axiom)',
    'A-0 System',
    'A+',
    'A++',
    'ABAP',
    'ABC',
    'ABC ALGOL',
    'ABSET',
    'ABSYS',
    'ACC',
    'Accent',
    'Ace DASL',
    'ACL2',
    'Avicsoft',
    'ACT-III',
    'Action!',
    'ActionScript',
    'Ada',
    'Adenine',
    'Agda',
    'Agilent VEE',
    'Agora',
    'AIMMS',
    'Alef',
    'ALF',
    'ALGOL 58',
    'ALGOL 60',
    'ALGOL 68',
    'ALGOL W',
    'Alice',
    'Alma-0',
    'AmbientTalk',
    'Amiga E',
    'AMOS',
    'AMPL',
    'Apex (Salesforce.com)',
    'APL',
    'AppleScript',
    'Arc',
    'ARexx',
    'Argus',
    'AspectJ',
    'Assembly language',
    'ATS',
    'Ateji PX',
    'AutoHotkey',
    'Autocoder',
    'AutoIt',
    'AutoLISP / Visual LISP',
    'Averest',
    'AWK',
    'Axum',
    'Active Server Pages',
    'ASP.NET'
  ];
  // Inline
  let TagifyCustomInlineSuggestion = new Tagify(TagifyCustomInlineSuggestionEl, {
    whitelist: whitelist,
    maxTags: 10,
    dropdown: {
      maxItems: 20,
      classname: 'tags-inline',
      enabled: 0,
      closeOnSelect: false
    }
  });
  // List
  let TagifyCustomListSuggestion = new Tagify(TagifyCustomListSuggestionEl, {
    whitelist: whitelist,
    maxTags: 10,
    dropdown: {
      maxItems: 20,
      classname: '',
      enabled: 0,
      closeOnSelect: false
    }
  });

  // Users List suggestion
  //------------------------------------------------------
  const TagifyUserListEl = document.querySelector('#TagifyUserList');

  async function fetchUsers() {
    try {
      const response = await fetch('http://127.0.0.1:8000/shareUserList');

      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }

      const users = await response.json(); // Await the JSON parsing
      const userData = users.data;

      const usersList = [];
      for (const user of userData) {
        console.log('user', user);

        // Assuming user has properties like id, name, avatar, and email
        usersList.push({
          value: user.id,
          name: user.name,
          avatar: user.avatar,
          email: user.email
        });
      }

      // Do something with the usersList, like rendering it on the UI or processing further
      console.log(usersList);
    } catch (error) {
      console.error('Error fetching users:', error);
    }
  }

  // Call the function to fetch users
  window.onload = function () {
    console.log('okk');
    fetchUsers();
  };

  function tagTemplate(tagData) {
    return `
    <tag title="${tagData.title || tagData.email}"
      contenteditable='false'
      spellcheck='false'
      tabIndex="-1"
      class="${this.settings.classNames.tag} ${tagData.class ? tagData.class : ''}"
      ${this.getAttributes(tagData)}
    >
      <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
      <div>
        <div class='tagify__tag__avatar-wrap'>
          <img onerror="this.style.visibility='hidden'" src="${tagData.avatar}">
        </div>
        <span class='tagify__tag-text'>${tagData.name}</span>
      </div>
    </tag>
  `;
  }

  function suggestionItemTemplate(tagData) {
    return `
    <div ${this.getAttributes(tagData)}
      class='tagify__dropdown__item align-items-center ${tagData.class ? tagData.class : ''}'
      tabindex="0"
      role="option"
    >
      ${
        tagData.avatar
          ? `<div class='tagify__dropdown__item__avatar-wrap'>
          <img onerror="this.style.visibility='hidden'" src="${tagData.avatar}">
        </div>`
          : ''
      }
      <div class="fw-medium">${tagData.name}</div>
      <span>${tagData.email}</span>
    </div>
  `;
  }
  function dropdownHeaderTemplate(suggestions) {
    return `
        <div class="${this.settings.classNames.dropdownItem} ${this.settings.classNames.dropdownItem}__addAll">
            <strong>${this.value.length ? `Add remaning` : 'Add All'}</strong>
            <span>${suggestions.length} members</span>
        </div>
    `;
  }

  // initialize Tagify on the above input node reference
  let TagifyUserList = new Tagify(TagifyUserListEl, {
    tagTextProp: 'name', // very important since a custom template is used with this property as text. allows typing a "value" or a "name" to match input with whitelist
    enforceWhitelist: true,
    skipInvalid: true, // do not remporarily add invalid tags
    dropdown: {
      closeOnSelect: false,
      enabled: 0,
      classname: 'users-list',
      searchKeys: ['name', 'email'] // very important to set by which keys to search for suggesttions when typing
    },
    templates: {
      tag: tagTemplate,
      dropdownItem: suggestionItemTemplate,
      dropdownHeader: dropdownHeaderTemplate
    },
    whitelist: usersList
  });

  // attach events listeners
  TagifyUserList.on('dropdown:select', onSelectSuggestion) // allows selecting all the suggested (whitelist) items
    .on('edit:start', onEditStart); // show custom text in the tag while in edit-mode

  function onSelectSuggestion(e) {
    // custom class from "dropdownHeaderTemplate"
    if (e.detail.elm.classList.contains(`${TagifyUserList.settings.classNames.dropdownItem}__addAll`))
      TagifyUserList.dropdown.selectAll();
  }

  function onEditStart({ detail: { tag, data } }) {
    TagifyUserList.setTagTextNode(tag, `${data.name} <${data.email}>`);
  }

  // Email List suggestion
  //------------------------------------------------------
  // generate random whitelist items (for the demo)
  let randomStringsArr = Array.apply(null, Array(100)).map(function () {
    return (
      Array.apply(null, Array(~~(Math.random() * 10 + 3)))
        .map(function () {
          return String.fromCharCode(Math.random() * (123 - 97) + 97);
        })
        .join('') + '@gmail.com'
    );
  });

  const TagifyEmailListEl = document.querySelector('#TagifyEmailList'),
    TagifyEmailList = new Tagify(TagifyEmailListEl, {
      // email address validation (https://stackoverflow.com/a/46181/104380)
      pattern:
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
      whitelist: randomStringsArr,
      callbacks: {
        invalid: onInvalidTag
      },
      dropdown: {
        position: 'text',
        enabled: 1 // show suggestions dropdown after 1 typed character
      }
    }),
    button = TagifyEmailListEl.nextElementSibling; // "add new tag" action-button

  button.addEventListener('click', onAddButtonClick);

  function onAddButtonClick() {
    TagifyEmailList.addEmptyTag();
  }

  function onInvalidTag(e) {
    console.log('invalid', e.detail);
  }
})();
