import { join } from 'path'
import type { Config } from 'tailwindcss'

export default <Partial<Config>>{
  content: [join(__dirname, 'stores/**/*.ts')],
  darkMode: 'class',
}
