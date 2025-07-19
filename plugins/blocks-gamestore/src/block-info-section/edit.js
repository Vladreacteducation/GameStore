import { __ } from '@wordpress/i18n';
import {
  useBlockProps,
  RichText,
  InspectorControls,
  MediaPlaceholder,
} from '@wordpress/block-editor';
import {
  PanelBody,
  TextControl,
  TextareaControl,
  ToggleControl,
} from '@wordpress/components';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
  const {
    title,
    description,
    link,
    linkText,
    image,
    rowReverse,
  } = attributes;

  return (
    <>
      <InspectorControls>
        <PanelBody title={__('Info Section Settings', 'blocks-gamestore')}>
          <TextControl
            label={__('Title', 'blocks-gamestore')}
            value={title}
            onChange={(value) => setAttributes({ title: value })}
          />
          <TextareaControl
            label={__('Description', 'blocks-gamestore')}
            value={description}
            onChange={(value) =>
              setAttributes({ description: value })
            }
          />

          <ToggleControl
            label={__('Reverse Layout', 'blocks-gamestore')}
            help={ rowReverse ? __('Content on right, image on left') : __('Content on left, image on right') }
            checked={rowReverse}
            onChange={(value) => setAttributes({ rowReverse: value })}
          />

          <TextControl
            label={__('Link URL', 'blocks-gamestore')}
            value={link}
            onChange={(value) => setAttributes({ link: value })}
          />
          <TextControl
            label={__('Link Text', 'blocks-gamestore')}
            value={linkText}
            onChange={(value) =>
              setAttributes({ linkText: value })
            }
          />

          {image && <img src={image} alt="" />}

          <MediaPlaceholder
            icon="format-image"
            labels={{ title: __('Image', 'blocks-gamestore') }}
            onSelect={(media) =>
              setAttributes({ image: media.url })
            }
            accept="image/*"
            allowedTypes={['image']}
          />
        </PanelBody>
      </InspectorControls>

      <div {...useBlockProps()}>
        <div
          className={`info-section-inner wrapper${rowReverse ? ' reverse' : ''}`}
        >
          <div className="info-section-inner-box">
            <RichText
              tagName="h2"
              className="info-section-title"
              value={title}
              onChange={(value) =>
                setAttributes({ title: value })
              }
            />
            <RichText
              tagName="p"
              className="info-section-description"
              value={description}
              onChange={(value) =>
                setAttributes({ description: value })
              }
            />
            {link && linkText && (
              <a
                className="info-section-button"
                href={link}
                target="_blank"
                rel="noopener noreferrer"
              >
                {linkText}
              </a>
            )}
          </div>
          {image && (
            <img
              src={image}
              className="info-section-image"
              alt=""
            />
          )}
        </div>
      </div>
    </>
  );
}
