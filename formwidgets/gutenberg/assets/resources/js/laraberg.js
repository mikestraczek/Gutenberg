import 'babel-polyfill'

import './../scss/laraberg.scss'

// Gutenberg imports
import './gutenberg/settings'
import getContent from './lib/get-content'
import init from './gutenberg/init'
import remove from './gutenberg/remove'
import { registerBlock, registerCategory } from './lib/custom-blocks'

const Laraberg = {
  init: init,
  initGutenberg: init,
  getContent: getContent,
  editor: null,
  registerCategory: registerCategory,
  registerBlock: registerBlock,
  remove: remove
}

window.Laraberg = Laraberg

export default Laraberg
