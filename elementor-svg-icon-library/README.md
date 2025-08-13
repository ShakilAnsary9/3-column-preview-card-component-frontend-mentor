# SVG Icon Library for Elementor

Adds a custom SVG icon library as a new tab in Elementor's icon picker.

## Install
- Copy the `elementor-svg-icon-library` folder to `wp-content/plugins/`.
- Activate the plugin in WordPress.
- Ensure Elementor is active.

## Usage
- In Elementor, open any icon control, then open the icon picker.
- Select the tab labeled "SILE Icons".

## Add your icons (separate SVG files)
- Put individual SVG files into: `assets/svg/`
- The icon name is derived from the filename (e.g., `arrow-right.svg` => `arrow-right`).
- SVG requirements:
  - Include a proper `viewBox` (e.g., `viewBox="0 0 24 24"`).
  - Inner paths should use `currentColor` for color inheritance.
  - Outer `<svg>` tag will be stripped automatically.

## How it works
- Elementor loads icons via a JSON endpoint defined by `fetchJson`.
- This plugin exposes an AJAX endpoint that scans `assets/svg/*.svg`, parses each, and returns a JSON in an Iconify-like format:

```json
{
  "prefix": "sile",
  "icons": {
    "check": { "body": "<path ... />", "width": 24, "height": 24 }
  }
}
```

## Customize
- Change the tab label, prefix, or label icon in `elementor-svg-icon-library.php` inside `sile_register_svg_icon_library()`.
- Default prefix is `sile`.

## Notes
- The AJAX endpoint is accessible at: `admin-ajax.php?action=sile_icons_json`.
- No need to maintain a manual JSON file; just drop SVGs into `assets/svg/`.