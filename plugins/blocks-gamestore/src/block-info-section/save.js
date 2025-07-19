import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save({ attributes }) {
  const {
    title,
    description,
    link,
    linkText,
    image,
    rowReverse,
  } = attributes;

  return (
    <div {...useBlockProps.save()}>
      <div
        className={`wrapper info-section-inner${rowReverse ? ' reverse' : ''}`}
      >
        <div className="info-section-inner-box">
          {title && (
            <RichText.Content
              tagName="h2"
              className="info-section-title"
              value={title}
            />
          )}
          {description && (
            <RichText.Content
              tagName="p"
              className="info-section-description"
              value={description}
            />
          )}
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
  );
}
