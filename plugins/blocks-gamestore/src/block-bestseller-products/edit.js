import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import './editor.scss';
import ServerSideRender from '@wordpress/server-side-render';

export default function Edit({ attributes, setAttributes }) {
  const { count, title, productType } = attributes;

	return (
    <>
    <InspectorControls>
      <PanelBody title={ __( 'Settings', 'blocks-gamestore' ) }>
        <TextControl
          label={ __( 'Count', 'blocks-gamestore' ) }
          value={ count }
          onChange={ ( val ) => setAttributes( { count: parseInt(val, 10) || 0 } ) }
        />
        <TextControl
          label={ __( 'Title', 'blocks-gamestore' ) }
          value={ title }
          onChange={ ( title ) => setAttributes( { title } ) }
        />
        <SelectControl
          label={ __( 'Select Type', 'blocks-gamestore' ) }
          value={ productType }
          onChange={ ( productType ) => setAttributes( { productType } ) }
          options={[
            {label: 'Bestseller', value: 'bestseller'},
            {label: 'Cross-Seller', value: 'crossseller'}, 
          ]}
        />
      </PanelBody>
    </InspectorControls>
    <div { ...useBlockProps() }>
      <ServerSideRender
        block="blocks-gamestore/bestseller-products"
        attributes={attributes}
      />
		</div>
    </>
		
	);
}
