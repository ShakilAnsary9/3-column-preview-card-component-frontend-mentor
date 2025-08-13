# SVG Icon Library for Elementor

Adds a custom SVG icon library as a new tab in Elementor's icon picker.

## Install
- Copy the `elementor-svg-icon-library` folder to `wp-content/plugins/`.
- Activate the plugin in WordPress.
- Ensure Elementor is active.

## Usage
- In Elementor, open any icon control, then open the icon picker.
- Select the tab labeled "SILE Icons".

## Add your icons
- Edit `assets/icons.json`.
- Each icon should be an entry under `icons` with a `body` that contains SVG path(s) only (no outer `<svg>` tag). Example:

```json
{
  "prefix": "sile",
  "icons": {
    "heart": {
      "body": "<path d=\"M12 21s-6-4.35-9-7.5C.6 10.06 2.4 6 6.6 6c2.1 0 3.4 1.2 5.4 3.2C14.94 7.2 16.2 6 18.3 6 22.5 6 24.3 10.06 21 13.5 18 16.65 12 21 12 21\" fill=\"currentColor\"/>",
      "width": 24,
      "height": 24
    }
  }
}
```

- Keep `width`/`height` consistent (e.g., 24) so icons look uniform.

## Notes
- This library uses Elementor's `elementor/icons_manager/additional_tabs` filter with `fetchJson` to load SVGs.
- `labelIcon` uses an Elementor admin icon class for the tab indicator.