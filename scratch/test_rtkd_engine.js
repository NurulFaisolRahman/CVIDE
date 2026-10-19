const fs = require('fs');

let elementStorage = {};
const mockDoc = {
  getElementById: function(id) {
    if (!elementStorage[id]) {
      elementStorage[id] = {
        id: id,
        innerHTML: '',
        value: '',
        closest: function() { return mockDoc.getElementById(id); },
        querySelector: function() { return null; },
        querySelectorAll: function() { return []; },
        classList: {
          add: function() {},
          remove: function() {}
        }
      };
    }
    return elementStorage[id];
  }
};

global.window = { RTKDEngine: null };
global.document = mockDoc;
global.jQuery = function() {
  return {
    on: function() {},
    find: function() { return { removeClass: function() {}, addClass: function() {} }; },
    closest: function() { return { removeClass: function() {}, addClass: function() {} }; },
    addClass: function() {},
    removeClass: function() {},
    is: function() { return false; },
    attr: function() { return ''; }
  };
};

const code = fs.readFileSync('assets/js/survei_rtkd_engine.js', 'utf8');
eval(code);

const engine = global.window.RTKDEngine;
console.log('RTKDEngine successfully evaluated in Node.js!');
console.log('Available instruments in SCHEMA:', Object.keys(engine.SCHEMA));

['A', 'B', 'C', 'D'].forEach(inst => {
  const s = engine.SCHEMA[inst];
  const qs = engine.allQs(inst);
  console.log(`\n--- Instrument ${inst}: ${s.name} ---`);
  console.log(`Total Blocks: ${s.blocks.length}`);
  console.log(`Total Questions: ${qs.length}`);
  s.blocks.forEach((b, bIdx) => {
    console.log(`  Block ${bIdx + 1} (${b.t}): ${b.qs.length} questions [${b.qs.map(q => q.c).join(', ')}]`);
  });
  
  engine.render('testSheet', inst);
  const html = mockDoc.getElementById('testSheet').innerHTML;
  console.log(`Rendered HTML length: ${html.length} chars`);
});

console.log('\nAll 4 instruments verified successfully!');
